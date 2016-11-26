<?php

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer;

        //$this->mail->SMTPDebug = 3;                               // Enable verbose debug output

        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp.yandex.ru'; //;smtp2.example.com';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'phpls1016@yandex.ru';                 // SMTP username
        $this->mail->Password = 'secret';                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 465;                                    // TCP port to connect to


        $this->mail->setFrom('phpls1016@yandex.ru', 'Mvc site');
        //$this->mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        //$this->mail->addAddress('ellen@example.com');               // Name is optional
        //$this->mail->addReplyTo('info@example.com', 'Information');
        //$this->mail->addCC('cc@example.com');
        //$this->mail->addBCC('bcc@example.com');

        //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        //$this->mail->isHTML(true);                                  // Set email format to HTML
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Subject = "Ваша регистрация успешно завершена!";
        //$this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    public function sendMail($email, $name)
    {
        // Set address
        $this->mail->addAddress($email, $name);
        // Set body
        $this->mail->Body = "$name, Ваша регистрация прошла успешно!\n
         Добро пожаловать на наш сайт!";
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }
}
