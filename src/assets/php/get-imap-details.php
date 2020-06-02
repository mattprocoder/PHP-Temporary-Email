<?php
//Enable this if you want to display warnings, error, notices and so on. (Simply command the line below)
//error_reporting(0);
function OpenImap()
{
    //Set your imap connection details, the format is usually
    //imap_open("{domain:143/novalidate-cert}", "username", "password")
    //With your own imap details of course.
    return imap_open("{address:143/novalidate-cert}", "username", "password");
}
function GetDeleteTime()
{
    $delete_in_days = 7; //Change this if you want to delete messages later/earlier
    return $delete_in_days * 24 * 60 *60; //Return the value in seconds, so we can compare it to unix timestamp of email
}
function EnableApiView()
{
    return true; //Change this depending on if you want to enable 'message' folder (API display) or no
}
function BlacklistedEmailAddresses($email_address)
{
    //Add email prefixes you want to not be accessible by anyone, such as test,admin,owner and so on
    $blacklisted_emails = [
        "catchall",
        "admin",
        "test",
        "owner"
    ];
    return in_array($email_address,$blacklisted_emails);
}
//Return error page location, so we don't have to change it in every single script manually.
function GetNotFoundPage(){
    return '../404/';
}
?>