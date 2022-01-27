<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        return $this->from('example@example.com', 'Example')
                ->view('Mail.userOrder')->with([
                    'name'     => $data['first_name']." ".$data['last_name'],        
                    'email'    => $data['email'],
                    'password' => $data['password'],
                    'price'    => $data['price'],
                    'quantity' => $data['quantity']

                ]);
    }
}

