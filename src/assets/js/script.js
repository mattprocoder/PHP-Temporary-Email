function CheckEmailOnLoad(){
    if(GatherCookie('t_email_address_1').length != 0)
    {
        //If cookie already exist, get email address from it and set it as current email address
        var current_address = GatherCookie('t_email_address_1');
        document.getElementById("mail-field").value = current_address;
        document.cookie = "t_email_address_1="+current_address+"; expires=Jan, 1 Dec 2999 12:00:00 UTC";
    }
    else{
        //If cookie doesn't exist, generate random address, and set it as current.
        var current_address = GenerateRandomAddress(8).toLowerCase()+"@billieiscute.xyz";
        document.getElementById("mail-field").value = current_address;
        document.cookie = "t_email_address_1="+current_address+"; expires=Jan, 1 Dec 2999 12:00:00 UTC";
    }
    setTimeout(function() { location.reload(); }, 25000);
}
function CopyEmailAddress(){
    //Copy all informations into clipboard, basic js function.
    var copyText = document.getElementById("mail-field");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    copyText.select
    document.execCommand("copy");
}
function ChangeEmailAddress(){
    //Check if email address is blacklisted, if it is, use random address instead
    if(CheckEmailAddress((document.getElementById("mail-field").value).split('@')[0]))
    {
        //Email address is blacklisted
        var current_address = GenerateRandomAddress(8).toLowerCase()+"@billieiscute.xyz";
        document.getElementById("mail-field").value = current_address;
        document.cookie = "t_email_address_1="+current_address+"; expires=Jan, 1 Dec 2999 12:00:00 UTC";
        location.reload();
    }
    else
    {
        //Email address isn't blacklisted
        document.getElementById("mail-field").value = document.getElementById("mail-field").value+"@billieiscute.xyz";
        var current_address = document.getElementById("mail-field").value;
        document.cookie = "t_email_address_1="+current_address+"; expires=Jan, 1 Dec 2999 12:00:00 UTC";
        location.reload();
    }
}
//Gather the cookie, as cookies are not being saved as string value;
function GatherCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}
//Generator of random email addresses.
function GenerateRandomAddress(length) 
{
    var result= '';
    var characters= 'abcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
//Check if the email address that user want to use isn't on our blacklist.
//This is using deprecated method, as it was the way that came on my mind.
//You can convert this as you want to, but this is working just fine as of now.
function CheckEmailAddress(email){
    blacklisted = false;
    $.ajax({
        url : "./assets/php/check-email-prefix.php?email="+email,
        type : "get",
        async: false,
        success : function(data) {
           if(data){
               blacklisted=true;
           }
           else{
               blacklisted=false;
           }
        },
        error: function() {  
        }
    });
    return blacklisted;
}