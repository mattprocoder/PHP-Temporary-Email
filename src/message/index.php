<?php
require('../assets/php/get-imap-details.php');
if(EnableApiView())
{
    GetMessageDetails();
}
else
{
    //Error message to display when this view is disabled.
    //You can also redirect this page to your 404 error page, so it'll look like it doesn't even exist.
    //Redirect using header, so header("Location: location"); die();
    echo "403 access not allowed";
}
//Get all message details, and display the as array
function GetMessageDetails()
{
    $message_id = $_GET["id"];
    $imap = OpenImap();
    $header = imap_header($imap, $message_id);
    if($header)
    {
        $message_body =  imap_fetchbody($imap, $message_id, 1);
        print_r($header);
        echo "<br>";
        echo $message_body;
    }
    else{
        echo "Message with id $message_id doesn't exist";
        die();
    }
}
?>