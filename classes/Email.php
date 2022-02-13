<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '59c26c4f59247d';
        $mail->Password = '611bc6d955bcfc';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','appsalon');
        $mail->Subject= 'confima tu cuenta';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola :".$this->email." has creado tu cuenta en app salon , solo debes confimarla presionando el siguinte enlace</p>";
        $contenido .= "<p> <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>confirmar aqui</a> </p>";
        $contenido .= "<p>si tu, no solisitaste esta cuenta, ignora el mensje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }


    public function enviarIntruciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '59c26c4f59247d';
        $mail->Password = '611bc6d955bcfc';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','appsalon');
        $mail->Subject= 'restablese tu password';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola :".$this->nombre." has  solicitado reestablecer tu password , presionando el siguinte enlace para hacerlo</p>";
        $contenido .= "<p> <a href='http://localhost:3000/recuperar?token=".$this->token."'>restablecer aqui</a> </p>";
        $contenido .= "<p>si tu, no solisitaste esta cuenta, ignora el mensje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}