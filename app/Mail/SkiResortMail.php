<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SkiResortMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $parsed_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parsed_data)
    {
        $this->view('email', $parsed_data);
        $this->subject('Спарсенные данные с сайта по горнолыжным курортам');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email');
    }
}
