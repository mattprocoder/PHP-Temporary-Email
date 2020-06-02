<?php
require('get-imap-details.php');
require('database-logging.php');
date_default_timezone_set('UTC');
function DisplayEmails($email_address)
{
    //Open Imap with given credentials.
    //LogAllActions(); //Un-Command this line if you want to log all actions.
    $imap = OpenImap();
    $messages = imap_check($imap); //Load all messages that are in our catchall inbox
    $messages_displayed = 0; //Count of emails already displayed
    $max_messages_on_screen = 50; //Max messages you want to display at once, in this case 50
    $email_in_blacklist = false;
    $imap_result = imap_fetch_overview($imap,"1:{$messages->Nmsgs}",0);
    foreach(array_reverse($imap_result) as $email)
    {
        //Check if the email address isn't blacklisted, if it is, don't display anything.
        if(!BlacklistedEmailAddresses(explode('@',$email_address)[0]))
        {
            if($email->deleted !=1)
            {
                //Go through all emails, but display only emails for the current email address
                if($email->to == $email_address && $messages_displayed <= $max_messages_on_screen)
                {
                    $messages_displayed += 1;
                    $message_id = $email->msgno;
                    $header = imap_header($imap, $message_id);
                    //The part of message we'll display as preview, you can change how many characters you want to display below.
                    $characters_to_display = 50;            
                    $message_preview = substr(imap_fetchbody($imap, $message_id, 1), 0, $characters_to_display);
                    $sender_address = $header->from[0]->mailbox."@".$header->from[0]->host;
                    //Display all email as separate table raw.
                    //You can change this by chaning the echo below onto your own one               
                    echo "<tr onclick=\"window.open('./view/?id=$message_id', '_blank')\"><th scope=\"row\">$sender_address</th><td>$email->subject</td><td>$message_preview</td></tr>";
                }
                $email_timestamp = $email->udate;
                //Check for every email if it's older than 7 days. If it is, delete.
                //This is only used when the page is loaded by someone, if you want to automate this in cron jobs please check 'delete-old-emails.php'
                //You can change delete timeframe in 'get-imap-details.php'
                if(time()-GetDeleteTime() > $email_timestamp)
                {
                    imap_delete($imap, $email->msgno); //Mark message with specific id as 'for delete'
                }
            }
        }
        else
        {
            $email_in_blacklist = true; //Email is in blacklist, don't display anything.
        }
    }
    //Display this content if there are no messages matching this email address
    if($messages_displayed == 0 && !$email_in_blacklist){
        echo "<tr><th scope=\"row\">This inbox is completely empty</th></tr>";
    }
    //Display if current email address is in blacklist, thus user can't access its content
    else if($email_in_blacklist){
        echo "<tr><th scope=\"row\">You can't view this email address</th></tr>";
    }
    //Delete all messages marked for delete, you can command the line below and keep them in your 'trash bin'
    imap_expunge($imap);
    imap_close($imap);
}
?>