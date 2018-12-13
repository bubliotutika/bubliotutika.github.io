<?php
class NewEmail
{
    protected $sendTo = 'benjamin.renel@epitech.eu';
    protected $object;
    protected $message;

    public function __contruct($object, $content, $senderEmail)
    {
        $this->object = $object;
        $this->message = '
                        <html>
                            <head>
                                <title>Ceci est un message depuis votre site</title>
                            </head>
                            <body>
                                <p><b>Email : </b>' . $senderEmail . '</p>
                                <p><b>Message : </b>' . $content . '</p>
                            </body>
                        </html>
                        ';

    }

    public function sendEmail()
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF8';

        if (mail($this->sendTo, $this->object, $this->message, implode("\r\n", $headers)))
        {
            echo "<p>Votre message a bien ete envoyer</p>";
        }
        else
        {
            echo "<p>Une erreur est survenue votre mail na pas pu etre envoyer</p>";
        }
    }
}

$newEmail = new NewEmail($_POST['object'], $_POST['message'], $_POST['contact-email']);
$newEmail->sendEmail();
?>