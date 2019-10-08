<?php

namespace Library\Provider;

use PHPMailer\PHPMailer\PHPMailer;

Class SendMailProvider
{	

  /**
    *
	* @var string
    *
    **/

	private $subject;
	
  /**
    *
	* @var string
    *
    **/

	private $body;

  /**
    *
	* @var array
    *
    **/

	private $from;

  /**
    *
	* @var string
    *
    **/

	private $attachment;

	/**
    *
    *-------------------------------------------------
    * Store Message Subject
    *-------------------------------------------------
    *
    * @var string $subject
    *
    **/

	public function subject($subject) 
	{
		$this->subject = $subject;
			return $this;
	}

	/**
    *
    *-------------------------------------------------
    * Store Message Body
    *-------------------------------------------------
    *
    * @var string $body
    *
    **/

	public function body($body) 
	{			return $this;
	}

	/**
    *
    *-------------------------------------------------
    * Store Message From
    *-------------------------------------------------
    *
    * @var array $from
    *
    **/
	public function from(array $from) 
	{
		$this->from = $from;
			return $this;
	}

	/**
    *
    *-------------------------------------------------
    * Store Message Attachment
    *-------------------------------------------------
    *
    * @var file $attachment
    *
    **/
	public function attachment($attachment) 
	{
		$this->attachment = $_FILES[$attachment];
			return $this;
	}

	/**
    *
    *-------------------------------------------------
    * Send Message
    *-------------------------------------------------
    *
    **/

	public function send()
	{	
		
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

		if (mailer['smtp'] == true) {
			//Enable SMTP debugging. 
			$mail->SMTPDebug = 0;                               
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();  
		}          
		//Set SMTP host name                          
		$mail->Host = mailer['host'];
	
		//Set TCP port to connect to 
		$mail->Port = mailer['port'];
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = mailer['smtp_secure'];
			//Set this to true if SMTP host requires authentication to send email
		if (mailer['smtp'] == true) {
			$mail->SMTPAuth = true; 
		} 

		//Provide username and password     
		$mail->Username = mailer['email'];                 
		$mail->Password = mailer['password'];
		
		                      
		$mail->setFrom('admin@markangelo-sila.com', 'My Name');
		
		$mail->addReplyTo('markangelo.sila@gmail.com');

		if (isset($this->attachment) && $this->attachment['error'] == UPLOAD_ERR_OK) {
			//Provide file path and name of the attachments
			$mail->addAttachment($this->attachment['tmp_name'], $this->attachment['name']);        
			$mail->addAttachment("images/profile.png"); //Filename is optional
		}
		
        $mail->isHTML(true);
        $mail->Subject = "Subject Text";
		$mail->Body = "<h1>SAMPLE MESSAGE</h1>";
		$mail->AltBody = 'This is a plain-text message body';
        

		//send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}

	}
			
}