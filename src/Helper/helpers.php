<?php


use Developerhouse\Quick\Exceptions\RedirectException;
use Illuminate\Http\Request;

if (!function_exists('get_greeting')) {
    /**
     * Devuelve el mensaje a mostrar en el menu sidebar
     *
     * @return string
     */
    function get_greeting(): string {

        $time = date('H');

        if ($time >= '5' && $time < '12') {
            return 'Buenos dias';
        }

        if ($time >= '12' && $time < '18') {
            return 'Buenas tardes';
        }

        return 'Buenas noches';

    }

}

if (!function_exists('detect')) {

    function detect() {
        $browser = ['IE', 'OPERA', 'MOZILLA', 'NETSCAPE', 'FIREFOX', 'SAFARI', 'CHROME'];
        $os      = ['WIN', 'MAC', 'LINUX', 'ANDROID', 'IPHONE'];

        # definimos unos valores por defecto para el navegador y el sistema operativo
        $info['browser'] = 'OTHER';
        $info['os']      = 'OTHER';
        $info['version'] = 'OTHER';

        # buscamos el navegador con su sistema operativo
        foreach ($browser as $parent) {
            $s       = stripos($_SERVER['HTTP_USER_AGENT'], $parent);
            $f       = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/', '', $version);
            if ($s) {
                $info['browser'] = $parent;
                $info['version'] = $version;
            }
        }

        # obtenemos el sistema operativo
        foreach ($os as $val) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $val) !== false) {
                $info['os'] = $val;
            }
        }

        $info['ip'] = get_real_ip();

        # devolvemos el array de valores
        return $info;
    }

}

if (!function_exists('get_real_ip')) {

    function get_real_ip() {
        return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_X_FORWARDED'] ?? $_SERVER['HTTP_FORWARDED_FOR'] ?? $_SERVER['HTTP_FORWARDED'] ?? $_SERVER['REMOTE_ADDR'];
    }
}

if (!function_exists('check_request')) {
    /**
     * Valida el formulario enviado por el usuario
     *
     * @param Request $request
     * @param array   $parameters
     * @param array   $messages
     *
     * @return void
     * @throws RedirectException
     */
    function check_request(Request $request, array $parameters, array $messages = []): void {

        $validator = Validator::make($request->all(), $parameters, $messages);

        if ($validator->fails()) {

            if ($request->expectsJson()) {
                $response = response(['error' => $validator->errors()->all()], 401);
            } else {
                $response = back()
                    ->withErrors($validator->errors()->all());
            }

            throw (new RedirectException)->setResponse($response);

        }

    }

}


if (!function_exists('expects_json_or_back')) {
    /**
     * Valido si el error se devuelve por un back o por json
     *
     * @param Request $request
     * @param string  $title
     * @param string  $msg
     *
     * @throws RedirectException
     */
    function expects_json_or_back(Request $request, string $title = '', string $msg = 'Esta acción no está autorizada.'): void {

        if ($request->expectsJson()) {

            $response = response([
                'title' => $title,
                'error' => $msg,
            ], 401);

        } else {

            $response = back()->with([
                'title' => $title,
                'error' => $msg,
            ]);

        }

        throw (new RedirectException)->setResponse($response);

    }

}

if (!function_exists('successful_message')) {
    /**
     * @param string $msg
     *
     * @return void
     */
    function successful_message(string $msg): void {
        Session::flash('success', $msg);
    }

}

if (!function_exists('error_message')) {
    /**
     * @param string $msg
     *
     * @return void
     */
    function error_message(string $msg): void {
        Session::flash('error', $msg);
    }

}
