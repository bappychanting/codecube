<?php

namespace App\Http\Controllers;

use Base\Mail;
use Base\BaseController; 

class Controller extends BaseController{

  public function sendMail($receivers = array(), $subject, $message, $sender = 'noreply@codecube.com', $cc = array(), $bcc = array()) 
  {
    $mail = new Mail; 
    $mail->setReceivers($receivers);  
    $mail->setSender($sender);
    $mail->setCarbonCopies($cc);
    $mail->setBlindCarbonCopies($bcc);
    $mail->setSubject($subject);
    $mail->setMessage($message);  
    $mail->createMessage()->send();
  }

}