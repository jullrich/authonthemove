function passwordhash(usernameID, passwordID, nonceID, cryptopasswordID) {
    var user=document.getElementById(usernameID).value;
    var pass=document.getElementById(passwordID).value;
    var nonce='';
    if ( nonceID!='' ) {
        nonce=document.getElementById(nonceID).value;
    }
    var cryptopass=mypasswordhash(pass,user);
    if ( nonce!='') {
        cryptopass=mypasswordhash(cryptopass,nonce);
    }
    document.getElementById(cryptopasswordID).value=cryptopass;
    document.getElementById(passwordID).value='';
}

function mypasswordhash(pass,salt) {
    return pass+salt;
}