<?php
namespace Clases;

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

    public function enviarConfirmacion(){
        //crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'ceae22140ca769';
        $mail->Password = 'c691fa6c2e34d7';


        $mail->setFrom('cuentas@transitounaula.com');
        $mail->addAddress('cuentas@transitounaula.com', 'transitounaula.com');
        $mail->Subject='Confirma tu cuenta';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido="<html>";
        $contenido.="<p><strong>Hola ". $this->nombre. "</strong> Has creado tu cuenta en transitoUnaula,
        solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido.= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token."'>Confirmar Cuenta</a> </p>";
        $contenido.="<p>Si no has solicitado esta cuenta, puedes ignorar este correo</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        //Enviar email
        $mail->send();
    }

    public function enviarInstrucciones(){
          //crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'ceae22140ca769';
        $mail->Password = 'c691fa6c2e34d7';


        $mail->setFrom('cuentas@transitounaula.com');
        $mail->addAddress('cuentas@transitounaula.com', 'transitounaula.com');
        $mail->Subject='Reestablece tu password';

        //set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido="<html>";
        $contenido.="<p><strong>Hola ". $this->nombre. "</strong> Has solicitado reestablecer tu password,
        sigue el siguiente enlace para hacerlo. </p>";
        $contenido.= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=". $this->token."'>Reestablecer password</a> </p>";
        $contenido.="<p>Si no has solicitado esta cuenta, puedes ignorar este correo</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        //Enviar email
        $mail->send();
    }
}
