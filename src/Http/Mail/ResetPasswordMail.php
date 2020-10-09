<?php


namespace Developerhouse\Quick\Http\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable {

    use Queueable, SerializesModels;

    public $data;
    public $link;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @param $link
     */
    public function __construct($data, $link) {
        $this->data = $data;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self {

        return $this->from('email@example.com')
            ->subject('Restablecimiento de contraseña')
            ->view('quick::layouts.auth.password.verify')
            ->with('names', $this->data->names . ' ' .$this->data->surnames);

    }
}