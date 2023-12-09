<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');
require 'PHPMailer/PHPMailerAutoload.php';
define('MSA_MAIL','multisoftacademy@gmail.com');
define('MSA_MAIL2','infos@msacad.com');
define('MSA_PWD','msoft2009');
define('MSA_PWD2','Bankai95&');

if ( ! function_exists('send')) {
    function send($creds=array())
    {
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;
        $mail->isSMTP();
        //$mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';// Enable verbose debug output

                                          // Set mailer to use SMTP
        $mail->Host = 'mail.msacad.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Port = 25;
        $mail->Username = $creds['userMail'];                 // SMTP username
        $mail->Password = $creds['userPassword'];                           // SMTP password
        //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                                         // TCP port to connect to

        $mail->setFrom($creds['from'][0], $creds['from'][1]);
        $mail->addAddress($creds['to'][0]);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($creds['replyTo'], 'C.F.P. MULTISOFT ACADEMY');
        $mail->addCC($creds['to'][0]);
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML($creds['html']);                                  // Set email format to HTML

        $mail->Subject = $creds['subject'];
        $mail->Body = $creds['message'];
        $mail->AltBody = htmlspecialchars($creds['message']);

        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}


if ( ! function_exists('sendNewLetter')) {
    function sendNewLetter($infos=array())
    {

        $info=(object) $infos;
        $data['mail']=$info;
        $creds = array(
            'userMail' => MSA_MAIL2,
            'userPassword' => MSA_PWD2,
            'from' => array(MSA_MAIL2, 'C.F.P. MULTISOFT ACADEMY'),
            'to' => array($info->email),
            'replyTo' => MSA_MAIL2,
            'cc' => $info->email,
            'html' => true,
            'subject' => utf8_decode($info->subject),
            'message' => $info->contenu
        );

        return send($creds);
    }
}

if ( ! function_exists('sendMail')) {
    function sendMail($infos=array())
    {
        $info=(object) $infos;
        $data['mail']=$info;
        $creds = array(
            'userMail' => MSA_MAIL2,
            'userPassword' => MSA_PWD2,
            'from' => array(MSA_MAIL2, 'C.F.P. MULTISOFT ACADEMY'),
            'to' => array($info->user->mail, ucwords($info->user->firstname).' '.mb_strtoupper($info->user->lastname)),
            'replyTo' => MSA_MAIL2,
            'cc' => $info->user->mail,
            'html' => true,
            'subject' => $info->title,
            'message' => mailView($data)
        );

        return send($creds);
    }
}

if(!function_exists('mailView')){
    function mailView($vars=array()){
        $CI = &get_instance();
        return $CI->load->view("email", $vars, true);
    }
}
