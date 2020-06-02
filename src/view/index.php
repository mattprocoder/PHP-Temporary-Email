<?php
$message_id = $_GET["id"];
require('../assets/php/get-imap-details.php');
$imap = OpenImap();
$header = imap_header($imap, $message_id);
//Check if the email was already deleted, if it was redired to error page (in this case 404)
if($header)
{
    //Get all message details we need, such as from,to,date and title and sender name.
    if($header->Deleted == 'D')
    {
        header('Location: '.GetNotFoundPage());
        die();
    }
    $from = $header->from[0]->personal;
    $from_address = $header->from[0]->mailbox."@".$header->from[0]->host;
    $to_address = $header->toaddress;
    $title = $header->subject;
    $date = $header->date;
    $message_body =  imap_fetchbody($imap, $message_id, 1);
    //Convert all links in emails to simple href, so in case the link is really long it won't display the site in some weird way.
    //It'll simply convert https://test.com into <a href="https://test.com" target="_blank">link</a>
    preg_match_all('/\b(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i', $message_body, $result, PREG_PATTERN_ORDER);
    foreach($result as $links){
        foreach($links as $link){
            $message_body = str_replace($link,"<a href=\"$link\" target=\"_blank\">link</a>",$message_body);
        }
    }
}
else{
    //Redirect to error page in case email with specific id doesn't exist
    header('Location: '.GetNotFoundPage());
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Billie is cute || Temporary E-Mail - Viewing <?php echo $message_id;?></title>
</head>
<body style="background-color: #1a1a1a;">
    <div class="header" style="text-align:center;margin-bottom: 2rem;margin-top: 1rem;">
        <a href="https://billieiscute.xyz" style="text-decoration:none;color:white;">
            <div style="font-size:5rem;font-weight:bolder;line-height: 0.85;">
                Billie<span style="font-size:7rem;color: rgb(255, 0, 157);">IS</span>Cute
            </div>
            <div>
                <span style="font-size: 2vw;">Temporary <span style="color: rgb(255, 0, 157);font-weight: bolder;">E-mail</span></span>
            </div>
        </a>
    </div>
    <div class="message">
        <div class="message-header">
            <span style="font-weight:bolder;font-size:1.5rem;">From:</span> <span style=";color: rgb(255, 0, 157)"><?php echo $from; ?></span>
            <br><span style="font-weight:bolder;font-size:1.5rem;">From Address:</span> <span style="color: rgb(255, 0, 157)"><?php echo $from_address; ?></span>
            <br><span style="font-weight:bolder;font-size:1.5rem;">To:</span> <span style="color: rgb(255, 0, 157)"><?php echo $to_address; ?></span>
            <br><span style="font-weight:bolder;font-size:1.5rem;">On:</span> <span style="color: rgb(255, 0, 157)"><?php echo $date; ?></span>
            <br><span style="font-weight:bolder;font-size:1.5rem;">Title:</span> <span style="color: rgb(255, 0, 157)"><?php echo $title; ?></span>
            <br><span style="font-weight:bolder;font-size:1.5rem;">Message:</span>
            <br>
            <div style="background-color: rgb(24, 24, 24);width:75%;padding:1rem;border-radius:10px;margin-bottom: 5rem;">
                <?php echo $message_body; ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <p style="margin-top:1rem;">This project is open source, and is available on <a href="https://github.com" target="_blank">Github</a></p>
    </div>
</body>
</html>