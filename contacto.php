<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jaime@webframe.cl";
    $email_subject = "CONTACTO - DANIAL";

    function died($error) {
        // your error code can go here
        echo "Lo sentimos, hemos encontrado un error. ";
        echo $error."<br /><br />";
        die();
    }



    $nombre = $_POST['nombre']; // required
    $telefono = $_POST['telefono']; // required
    $email = $_POST['email']; // required
    $comments = $_POST['comments']; // required


    $email_message = "Los datos del interesado son:\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Teléfono: ".clean_string($telefono)."\n";
    $email_message .= "Correo: ".clean_string($email)."\n\n";
    $email_message .= "Comentario: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=./index.html\">";
?>

<?php
}
?>
