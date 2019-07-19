<?php

namespace Base;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{

  private $sender;
  private $receivers = array();
  private $carbonCopies = array();
  private $blindCarbonCopies = array();
  private $subject;
  private $message;
  private $attachments = array();

  /* Setter getter for all variables */

    // Sender setter getter
  function setSender($sender){
    $this->sender = strtolower(strip_tags($sender));
  }
  function getSender(){
    return $this->sender;
  }

    // Reciever setter getter
  function setReceivers($receivers){
    if(is_array($receivers) && count($receivers) >= 1){
      $this->receivers = $receivers;
    }
  }
  function getReceivers(){
    return $this->receivers;
  }

    // Carbon Copy setter getter
  function setCarbonCopies($carbonCopies){
    if(is_array($carbonCopies) && count($carbonCopies) >= 1){
      $this->carbonCopies = $carbonCopies;
    }
  }
  function getCarbonCopies(){
    return $this->carbonCopies;
  }

    // Blind Carbon Copy setter getter
  function setBlindCarbonCopies($blindCarbonCopies){
    if(is_array($blindCarbonCopies) && count($blindCarbonCopies) >= 1){
      $this->blindCarbonCopies = $blindCarbonCopies;
    }
  }
  function getBlindCarbonCopies(){
    return $this->blindCarbonCopies;
  }

    // Subject setter getter
  function setSubject($subject){
    $this->subject = ucwords($subject);
  }
  function getSubject(){
    return $this->subject;
  }

    // Message setter getter
  function setMessage($message){
    $this->message = $message;
  }
  function getMessage(){
    return $this->message;
  }

    // Attachment setter getter
  function setAttachments($attachments){
    if(is_array($attachments) && count($attachments) >= 1){
      $this->attachments = $attachments;
    }
  }
  function getAttachments(){
    return $this->attachments;
  }

    // Send SMTP Mail
  private function sendSMTP(){

    $mail = new PHPMailer(TRUE);

    $mail->SMTPDebug = 2;                                       
    $mail->isSMTP();                      
    $mail->Host       = MAIL_HOST;          
    $mail->SMTPAuth   = TRUE;                              
    $mail->Username   = MAIL_USERNAME;            
    $mail->Password   = MAIL_PASSWORD;         
    $mail->SMTPSecure = MAIL_ENCRYPTION;      
    $mail->Port       = MAIL_PORT; 

        //Recipients
    $mail->setFrom($this->getSender()); 

    if(!empty($this->getReceivers())){
      foreach ($this->getReceivers() as $name => $address) {
        $mail->addAddress($address, is_numeric($name) ? '' : $name);     
      }
    }     
    
    $mail->addReplyTo(MAIL_USERNAME);

    if(!empty($this->getCarbonCopies())){
      foreach ($this->getCarbonCopies() as $cc) {
        $mail->addCC($cc);     
      }
    }

    if(!empty($this->getBlindCarbonCopies())){
      foreach ($this->getBlindCarbonCopies() as $bcc) {
        $mail->addBCC($bcc);     
      }
    }

        // Attachments

    if(!empty($this->getAttachments())){
      foreach ($this->getAttachments() as $file => $name) {
        $mail->addAttachment($file, is_numeric($name) ? '' : $name);     
      }
    }   

    $mail->isHTML(true);                                  
    $mail->Subject = $this->getSubject();
    $mail->Body    = $this->getMessage();

    $mail->send();

  }

    // Create the message body
  public function createMessage(){

    if (file_exists("resources/markups/mail.xml")){
      $xml = simplexml_load_file("resources/markups/mail.xml") or die(logger('ERROR: Can  not load xml file'));
    }
    else{ 
      throw new \Exception("&quot;mail.xml&quot; not found! This file is required for parsing mail classes. Please create a &quot;mail.xml&quot; file in the &quot;resources > markup&quot; folder containing markup for &headings&quot;, &quot;paragraphs&quot;, &quot;background&quot;  tags, and add styles for classes in the &quot;styling&quot; tag!");
    }

    $header = $xml->header;
    $style = $xml->style;
    $footer = $xml->footer;

    $message = '<html><head><style>'.$style.'</style></head><body>'.$header.'<br>'.$this->getMessage().'<br>'.$footer.'</body></html>';

    $this->setMessage($message);

    return $this;

  }

    // Send Mail
  public function send(){

    switch(MAIL_DRIVER) {
      case 'smtp': 
      $this->sendSMTP();
      break;
    }

  }


}

?>
