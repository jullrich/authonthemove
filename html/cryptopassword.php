<?php
session_start();
require_once('../php/Userdata.php');
$oUserData=new Userdata();
/** @var $oUserData Userdata */
$sUsername=$oUserData->get_alphanum('username');
$sCryptoPassword=$oUserData->get_password('cryptopassword');

$sNonce=sha1(rand(0,PHP_INT_MAX).time());


/* storing username and password. Here, we are just testing, so we keep it in the session */

$_SESSION['username']=$sUsername;
$_SESSION['password']=$sCryptoPassword;
$_SESSION['nonce']=$sNonce;

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="apple-mobile-web-app-capable" content="yes">


    <link href="authonthemove.css" rel="stylesheet" type="text/css">
    <script src="drawdots.js"></script>

    <title>AuthOnTheMove: Experimental Authentication Methods for Mobile Web Applications</title>
</head>
<body>
<h1>Client Side Password Hashing: Login</h1>

<div>
    <form action="cryptopassword.php" onsubmit="passwordhash('username','password','nonce', 'cryptopassword')">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="" required pattern="[A-Za-z0-9]+" >
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
        <label for="password2">Retype Password</label>
        <input type="hidden" id="nonce" value="<?php safe_out($sNonce,'HTML'); ?>" >
        <input type="hidden" id="cryptopassword" value="">

        <input type="submit" value="Submit">
    </form>
</div>
<div>
    <h3>For demo/debug purposes: Session content</h3>
    <pre>
        <?php
        safe_out(print_r($_SESSION,true));
        ?>

    </pre>


</div>


<div>
    The source code for this site can be found at GitHub: <a href=https://github.com/jullrich/authonthemove">https://github.com/jullrich/authonthemove</a>.
</div>
<div>
    All code on this site is licensed under the GPLv2. All other
    content is licensed using a creative commons license. See respective license documents for details.
</div>
<footer>
    <a href="list.html">Index</a>
    <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img alt="Creative Commons License"
                                                                                          style="border-width:0"
                                                                                          src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png"/></a><br/>
    <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://purl.org/dc/terms/
http://purl.org/dc/terms/ ">AuthOnTheMove</span> by <a
        xmlns:cc="http://creativecommons.org/ns#" href="http://www.authonthemove.com" property="cc:attributionName"
        rel="cc:attributionURL">the SANS Technology Institute</a> is licensed under a <a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">Creative
        Commons Attribution-ShareAlike 3.0 Unported License</a>.<br/>
</footer>
</body>
</html>