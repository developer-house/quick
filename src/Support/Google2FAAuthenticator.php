<?php


namespace Developerhouse\Quick\Support;

use Developerhouse\Quick\Models\Tables\PasswordSecurity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response as IlluminateHtmlResponse;
use Illuminate\View\View;
use PragmaRX\Google2FALaravel\Events\OneTimePasswordRequested;
use PragmaRX\Google2FALaravel\Events\OneTimePasswordRequested53;
use PragmaRX\Google2FALaravel\Exceptions\InvalidSecretKey;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Google2FAAuthenticator extends Authenticator {

    /**
     * @return bool
     */
    protected function canPassWithoutCheckingOTP(): bool {

        $passwordSecurity = PasswordSecurity::whereUserId($this->getUser()->id)->first();

        if ($passwordSecurity->google2fa_enable === 0) {
            return true;
        }

        return
            !$passwordSecurity->google2fa_enable ||
            !$this->isEnabled() ||
            $this->noUserIsAuthenticated() ||
            $this->twoFactorAuthStillValid();
    }

    protected function getGoogle2FASecretKey() {

        $passwordSecurity = PasswordSecurity::whereUserId($this->getUser()->id)->first();

        $secret = $passwordSecurity->{$this->config('otp_secret_column')};

        if ($secret === null || empty($secret)) {
            throw new InvalidSecretKey('Secret key cannot be empty.');
        }

        return $secret;
    }

    /**
     * Create a response to request the OTP.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function makeRequestOneTimePasswordResponse() {
        event(
            app()->version() < '5.4'
                ? new OneTimePasswordRequested53($this->getUser())
                : new OneTimePasswordRequested($this->getUser())
        );

        $expectJson = app()->version() < '5.4'
            ? $this->getRequest()->wantsJson()
            : $this->getRequest()->expectsJson();

        return $expectJson
            ? $this->makeJsonResponse($this->makeStatusCode())
            : $this->makeHtmlResponse($this->makeStatusCode());
    }

    /**
     * Make a web response.
     *
     * @param $statusCode
     *
     * @return \Illuminate\Http\Response
     */
    protected function makeHtmlResponse($statusCode) {

        $view = $this->getView();

        if ($statusCode !== SymfonyResponse::HTTP_OK) {
            $view->withErrors($this->getErrorBagForStatusCode($statusCode));
        }

        return new IlluminateHtmlResponse($view, $statusCode);
    }

    /**
     * Get the OTP view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function getView() {
        return view('quick::layouts.auth.2fa');
    }

}
