<?php


namespace App\Services\Message\Email;


use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{

    //// details
    private $details;
    public function getDetails()
    {
        return $this->details;
    }
    public function setDetails($details)
    {
        $this->details = $details;
    }

    //// subject
    protected $subject;
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /// from
    private $from = [
        ['address' => null ,'name' => null]
    ];
    public function getFrom()
    {
        return $this->from;
    }
    public function setFrom($address,$name)
    {
        $this->from = [
           [
            'address' => $address,
            'name' => $name
           ]
        ];
    }

    //// to
    private $to;
    public function getTo()
    {
        return $this->to;
    }
    public function setTo($to)
    {
        $this->to = $to;
    }

    //// files
    private $emailFiles;
    public function getEmailFiles()
    {
        return $this->emailFiles;
    }
    public function setEmailFiles($emailFiles)
    {
        $this->emailFiles = $emailFiles;
    }


    // for send email to given address
    // this fire() method define in MessageInterface
    public function fire()
    {
            //           Mail::to($this->to)
            //           ->send(new MailViewProvider($this->details,$this->subject,$this->from,public_path('/attachment/mag2.jpg')));
           Mail::to($this->to)->send(new MailViewProvider($this->details,$this->subject,$this->from,$this->emailFiles));
           return true;
    }
}
