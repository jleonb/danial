<?php

$email;$comment;$captcha;
if(isset($_POST['nombre'])){
  $first_name=$_POST['nombre'];
}if(isset($_POST['telefono'])){
  $last_name=$_POST['telefono'];
}if(isset($_POST['email'])){
  $email=$_POST['email'];
}if(isset($_POST['comments'])){
  $comments=$_POST['comments'];
}if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  echo '??';
  exit;
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcYjREUAAAAAMevyUA2Ou5SdKM7ddDktuWuvi8U&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);



if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "danial@danialsolution.cl";
    $email_subject = "Contacto Web";

    function died($error) {
        // your error code can go here
        echo "Lo sentimos, pero hemos encontrado error(es) en el formulario. ";
        echo "Este es el error(es):<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor vualva y solucione el error(es).<br /><br />";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['nombre']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['comments'])) {
        died('Lo sentimos, pero estos errores parecen ser el problema.');
    }

    $first_name = $_POST['nombre']; // required
    $last_name = $_POST['telefono']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'El email no es válido.<br />';
  }
    $string_exp = "/^[A-Za-z\s.'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Nombre no válido.<br />';
  }
    $string_exp = "/^[A0-9._%-]+$/";
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Teléfono no válido.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'Comentarios no válidos.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Los datos ingresados son los siguientes.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Teléfono: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comentarios: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=index.html#contacto\">";
?>

<?php
}
?>
