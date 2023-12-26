<?php

namespace App\Http\Controllers\Front\ContactUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        return view('front.contact_us.contact_us');
    }
}
