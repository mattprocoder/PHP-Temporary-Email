<?php
require('get-imap-details.php');
//Delete all emails older than 7 days using cron jobs.
//You can also set custom deletation in 'get-imap-details.php'
DeleteOldMessages();
function DeleteOldMessages()
{
    $imap = OpenImap();
    $messages = imap_check($imap);
    $imap_result = imap_fetch_overview($imap,"1:{$messages->Nmsgs}",0); //Get overview of messages in catchall inbox.
    foreach(array_reverse($imap_result) as $email)
    {
        //Delete the email only if it's not already deleted.
        if($email->deleted !=1)
        {
            $email_timestamp = $email->udate;
            if(time()-GetDeleteTime() > $email_timestamp)
            {
                imap_delete($imap, $email->msgno);
            }
        }
    }
    //Delete all messages marked for delete, you can command the line below and keep them in your 'trash bin'
    imap_expunge($imap);
    imap_close($imap);
}
?>