<?php
  
namespace App\Base;
  
class Mail
{

  private $receiver;
  private $sender;
  private $carbonCopy;
  private $blindCarbonCopy;
  private $subject;
  private $headers;
  private $message;

  /* Setter getter for all variables */

    // Reciever setter getter
  function setReceiver($receiver){
      $this->receiver = strtolower(strip_tags($receiver));
  }
  function getReceiver(){
      return $this->receiver;
  }

    // Sender setter getter
  function setSender($sender){
      $this->sender = strtolower(strip_tags($sender));
  }
  function getSender(){
      return $this->sender;
  }

    // Carbon Copy setter getter
  function setCarbonCopy($carbonCopy){
      $this->carbonCopy = strip_tags($carbonCopy);
  }
  function getCarbonCopy(){
      return $this->carbonCopy;
  }

    // Blind Carbon Copy setter getter
  function setBlindCarbonCopy($blindCarbonCopy){
      $this->blindCarbonCopy = strip_tags($blindCarbonCopy);
  }
  function getBlindCarbonCopy(){
      return $this->blindCarbonCopy;
  }

    // Subject setter getter
  function setSubject($subject){
      $this->subject = ucwords($subject);
  }
  function getSubject(){
      return $this->subject;
  }

    // Header setter getter
  function setHeader($headers){
      $this->headers = $headers;
  }
  function getHeader(){
      return $this->headers;
  }

    // Message setter getter
  function setMessage($message){
      $this->message = $message;
  }
  function getMessage(){
      return $this->message;
  }

  public function createHeader(){

    $headers = "From: " . $this->getSender() . "\r\n";
    $headers .= "Reply-To: ". $this->getSender() . "\r\n";
    if(!empty($this->getCarbonCopy())){
      $headers .= "CC: ".."\r\n";
    }
    if(!empty($this->getCarbonCopy())){
      $headers .= "BCC: ".$this->getBlindCarbonCopy()."\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $this->setHeader($headers);
       
    return $this;

  }

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

  public function send(){
    if(!empty($this->getReceiver()) && !empty($this->getSubject()) && !empty($this->getMessage())){
      $isSend = mail($this->getReceiver(), $this->getSubject(), $this->getMessage(), $this->getHeader());
      if($isSend) {
        return TRUE;
      }
    }
    return FALSE;

  }

}
  
?>
