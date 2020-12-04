<?php
namespace App\Controllers;

use App\Core\Controller;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

class Mail extends Controller
{
    public $senderemail = "gerald@legacyuniversity.edu.ng";
    public $sendername = APP_NAME;
    public $replytoemail = "gerald@legacyuniversity.edu.ng";
    public $replytoname = APP_NAME;
    public $subject;
    public $body;
    public $receiver;
    public $phpmailer;

    public function sendemail()
    {
        $this->phpmailer = new PHPMailer();

        try {
            //Server settings
            $this->phpmailer->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $this->phpmailer->isSMTP();                                            // Send using SMTP
            $this->phpmailer->Host       = 'secure265.inmotionhosting.com';                    // Set the SMTP server to send through
            $this->phpmailer->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->phpmailer->Username   = 'gerald@legacyuniversity.edu.ng';                     // SMTP username
            $this->phpmailer->Password   = '!@#$%Odogwu';                               // SMTP password
            $this->phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->phpmailer->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $this->phpmailer->setFrom($this->senderemail, $this->sendername);
            
            $this->phpmailer->addAddress($this->receiver);               // Name is optional
        
            // Content
            $this->phpmailer->isHTML(true);                                  // Set email format to HTML
            $this->phpmailer->Subject = $this->subject;
            $this->phpmailer->Body    = $this->body;
            $this->phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $send = $this->phpmailer->send();

            if (!$send) {
                return 0;
            }
            return 1;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->phpmail->ErrorInfo}";
        };
    }

    public function template()
    {
        ob_start();
        include_once dirname(__DIR__).'/Layouts/email.php';
        return ob_get_clean();
    }

    public function inject($template, $sitetitle, $caption, $email, $body, $link = null)
    {
        $template = str_replace('[site_title]', $sitetitle, $template);
        $template = str_replace('[caption]', $caption, $template);
        $template = str_replace('[email]', $email, $template);
        $template = str_replace('[body]', $body, $template);
        $template = str_replace('[site_title]', $sitetitle, $template);
        $template = str_replace('[link]', $link, $template);

        return $template;
    }
}
