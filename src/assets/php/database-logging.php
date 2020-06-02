<?php
//Log every sigle action on the website, logs also when the website refreshes itself (depends on where you use this function)
function LogAllActions(){
    $servername = "localhost"; //Server address the database is hosted on
    $username = "root"; //Your database manager username
    $password = ""; //Your database manager password
    $dbname = "billieiscute"; //Name of database itself
    $email_address = $_COOKIE['t_email_address_1']; //Get email address to log from cookie
    $table_name = "emails"; //Get table you want to save data into
    $accessed_by = GetAccessedBy(); //Get ip address of user that accessed specific email address
    date_default_timezone_set("UTC"); //Set default timezone to UTC, so we always get UTC date
    $date_unix = gmdate("Y-m-d\TH:i:s\Z"); //Format UTC time
    $unix = time(); //Get UTC timestamp

    $conn = new mysqli($servername, $username, $password, $dbname); //Create connection between current server and database

    if ($conn->connect_error) 
    {
        //Error occured, do some action you want to do
        //Redirect, log, or return some value here
    }

    $sql = "INSERT INTO $table_name (email_address, accessed_by, unix_timestamp,date_time)
    VALUES ('$email_adress','$accessed_by','$unix','$date_unix')"; //Get table, select fields and insert values into it

    if ($conn->query($sql) === TRUE)
    {
        //Record successfully saved into database
        //You can continue in logging here, or eventually display message / return value
    }
    else 
    {
        //Error occured when writing into databse, do some action here.
        //You can put redirect, messages and so on here.
    }

    $conn->close();
}
function GetAccessedBy() 
{
    //Get every single possible redirect, and get ip address from it (you can't get address behind VPN with this)
    //I recommend encrypting the output. So in case of data breach nothing will be 'leaked'
    //I'm not doing it here, as I wouldn't be able to debug on localhost then.
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>