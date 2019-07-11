<?php

namespace App\Http\Controllers;

use Base\Mail;
use Base\BaseController; 

class Controller extends BaseController{

  public function sendMail($receivers = array(), $subject, $message, $cc = array(), $bcc = array()) 
  {
    $config = $this->config('app');
    $mail = new Mail; 
    $mail->setReceiver(implode(", ", $receivers)); 
    $mail->setSender($config['mail']);
    $mail->setCarbonCopy(implode(", ", $cc));
    $mail->setBlindCarbonCopy(implode(", ", $bcc));
    $mail->setSubject($subject);
    $mail->setMessage($message);  
    $mail->createHeader()->createMessage()->send();
  }

}