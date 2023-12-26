<?php


namespace App\Services\Message\SMS;


use Illuminate\Support\Facades\Config;

class MelliPayamakService
{
    private $user_name;
    private $password;

    public function __construct()
    {
        $this->user_name = Config::get('sms.user_name');
        $this->password = Config::get('sms.password');
    }

    public function addContact()
    {
        // fill body later
    }

    public function addSchedule()
    {
        // fill body later
    }

    public function getCredit(){
        // fill body later
    }

    public function getInboxCountSoapClient()
    {
        // fill body later
    }

    public function getMessageStr()
    {
        // fill body later
    }

    public function SendSimpleSms2SoapClient()
    {
        // fill body later
    }

    public function sendSmsNuSoap()
    {
        // fill body later
    }

    // send sms with below method
    public function sendSmsSoapClient($from,array $to,$text,$is_flash = true)
    {
        // fill body later
    }

}
