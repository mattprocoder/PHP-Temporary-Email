<?php
require('get-imap-details.php');
$email = $_GET['email']; //Get email address from query (https://address/?email=test)
//Return the value itself, used in js to pass the value in js function
echo BlacklistedEmailAddresses($email);
?>