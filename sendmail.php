<?php

$to = 'muhamedsadovic41@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = array(
    'From' => 'medmedorl121@gmail.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
?>