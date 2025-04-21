<?php


/**
* 
*
* @author GerardoSteven (Steven0110)
*/

namespace App\Http\Controllers;

use App\Mail\E_Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller{

    public static function sendMail( $header, $raw_body, $footer, $subject, $to){
        //$email_to = 'gcabello@mbrhosting.com';
        Mail::to($to)->send(new E_Mail( $header, $raw_body, $footer, $subject ));
        return empty(Mail::failures()) ? true : Mail::failures();
    }
}
