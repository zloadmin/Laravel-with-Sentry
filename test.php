<?php
$to = "recipient@example.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
if (mail($to, $subject, $body)) {
    echo("<p>Email successfully sent!</p>");
} else {
    echo("<p>Email delivery failed…</p>");
}
?>