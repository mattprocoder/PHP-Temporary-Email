<?php
$mbox = imap_open("{address:143/novalidate-cert}", "username", "password")
     or die("can't connect: " . imap_last_error());

$MC = imap_check($mbox);

// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
foreach ($result as $overview) {
    echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from}
    {$overview->subject} {$overview->to}\n";
}
imap_close($mbox);
?>