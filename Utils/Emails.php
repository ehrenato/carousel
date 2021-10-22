<?php
namespace Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Emails{

    public static function enviarEmail($email, $name,  $assunto, $conteudo){
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'a550e8e4d5c7f4';
            $mail->Password = '39e70375468254';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;

            $mail->setFrom('naoresponda@email.com', 'Atendimento');
            $mail->addAddress($email, $name);

           /* if(isset($attachment['name']) && !empty($attachment['name'])){
                $mail->addAttachment($attachment['tmp_name'], $attachment['name']);
            }*/

            $mail->isHTML(true);
            $mail->Subject = "E-mail Teste";

            $mail->Body = "Prezado {$name} <br><br>Email enviado para {$assunto}<br>Assunto:{$conteudo}";
            $mail->AltBody = "Prezado {$name} \n\nEmail enviado para {$assunto}\n\nAssunto:{$conteudo}";
            $mail->send();
            /*if ($mail->send()) {
                //echo "PHPMAIL OK";
                $mail->clearAddresses();
                header("Location:index.php");
                exit;
            } else {
                echo "Error Send";
            }*/
            echo "Mensagem de contato enviado";
        } catch (\Exception $e) {
            echo "ERROR PHP MAILER:{$mail->ErrorInfo}";
        }
    }
}