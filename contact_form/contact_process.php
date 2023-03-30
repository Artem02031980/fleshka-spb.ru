<?php

include dirname(dirname(__FILE__)).'/mail.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'email_validation.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = '
Имя: '.$_POST['name'].'
Email: '.$_POST['email'].'                        
Телефон: '.$_POST['subject'].'
Сообщение: '.$_POST['message'].'
';


$error = '';

// Check name

if(!$name)
{
$error .= 'Введите Имя<br />';
}

// Check email

if(!$email)
{
$error .= 'Введите Email<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Пожалуйста, введите корректный Email<br />';
}




if(!$error)
{
$mail = mail(CONTACT_FORM, $subject = 'Оригинальная Флэшка', $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion())
	."Content-type: text/html; charset=utf-8 \r\n";

if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>