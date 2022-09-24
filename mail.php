<?php

$to      = 'muhamedsadovic41@gmail.com';
$subject = 'the subject';
$message = 'babusaneee';
$headers = array(
    'From' => 'muhamedsadovic01@gmail.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
?>