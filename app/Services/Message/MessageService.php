<?php


namespace App\Services\Message;


use App\Http\Interfaces\MessageInterface;

class MessageService
{

    private $message;

    public function __construct(MessageInterface $message)
    {
        // put messageInterface into message variable
        // use this property as interface
        $this->message = $message;
    }

    public function send()
    {
        return $this->message->fire();
    }



}
