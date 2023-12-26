<?php


namespace App\Services\Message\SMS;


use App\Http\Interfaces\MessageInterface;

class SmsService implements MessageInterface
{

    private $from;
    private $text;
    private $to;
    private $is_flash = true;

    //// text
    public function getText()
    {
        return $this->text;
    }
    public function setText($text)
    {
        $this->text = $text;
    }

    //// from
    public function getFrom()
    {
        return $this->from;
    }
    public function setFrom($from)
    {
        $this->from = $from;
    }

    //// to
    public function getTo()
    {
        return $this->to;
    }
    public function setTo($to)
    {
        $this->to = $to;
    }

    //// is flash
    public function getIsFlash()
    {
        return $this->is_flash;
    }
    public function setIsFlash($is_flash)
    {
        $this->is_flash = $is_flash;
    }


    public function fire()
    {
        $melliPayamak = new MelliPayamakService();
        return $melliPayamak->sendSmsSoapClient($this->from,$this->to,$this->text,$this->isFlash);
    }
}
