<?php
require_once('../php/Userdata.php');
$oUserData=new Userdata();
$sUsername=$oUserData->get_alphanum('username');


?>
<!DOCTYPE HTML>
<html>
<head>
    <link href="authonthemove.css" rel="stylesheet" type="text/css">
    <title>AuthOnTheMove: Using Session Storage to &quot;harden&quot; Sessions.</title>
</head>
<body>
<h1>AuthOnTheMove: Session Storage</h1>
<div>
    You are now logged in as <?php safe_out($sUsername) ?>. Refresh this page to make sure you are still logged in.

</div>
    <footer>
        <a href="list.html">Index</a>
        <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img alt="Creative Commons License"
                                                                                              style="border-width:0"
                                                                                              src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png"/></a><br/>
        <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">AuthOnTheMove</span> by <a
            xmlns:cc="http://creativecommons.org/ns#" href="http://www.authonthemove.com" property="cc:attributionName"
            rel="cc:attributionURL">the SANS Technology Institute</a> is licensed under a <a rel="license"
                                                                                             href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">Creative
            Commons Attribution-ShareAlike 3.0 Unported License</a>.<br/>
    </footer>
</body>
</html>