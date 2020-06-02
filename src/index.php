<?php
require('assets/php/get-emails.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Billie is cute || Temporary E-Mail</title>
</head>
<body style="background-color: #1a1a1a;" onload="CheckEmailOnLoad()">
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
    <div style="text-align:center;">
        <span class="change-on-hover" onclick="CopyEmailAddress()">E-mail address (click to copy)</span>
        <div class="input-group" style="width: 25%;margin-left: 36.9%;">
            <input style="text-align: center;" type="text" class="form-control" value="default@billieiscute.xyz" id="mail-field" onchange="ChangeEmailAddress()">
        </div>
    </div>
    <div style="width:50%;margin-left:24%;margin-top:1rem;margin-bottom:5rem;">
        <table class="table table-dark" style="background-color: #111111;" id="inbox">
            <thead>
                <tr style="color: rgb(255, 0, 157);text-align: center;font-weight: bolder;border:solid #111111 3px;border-radius: 10rem;">
                    <th scope="col">From</th>
                    <th scope="col">Title</th>
                    <th scope="col">Preview</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                <?php
                    //Display all emails for current email address (the email address stored in cookies);
                    DisplayEmails($_COOKIE['t_email_address_1']);
                ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p style="margin-top:1rem;">This project is open source, and is available on <a href="https://github.com" target="_blank">Github</a></p>
    </div>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>