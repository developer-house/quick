<?php


namespace Developerhouse\Quick\Http\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class ConfirmAccountMail {

    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self {

        return $this->from('email@example.com')
            ->subject('Términos y Condiciones - Global Red')
            ->view('mail.user.welcome')
            ->with('names', $this->data->names);

    }
}