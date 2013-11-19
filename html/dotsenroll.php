<?php

require_once('../php/Userdata.php');
$oUserData=new Userdata();
$sUsername=$oUserData->get_alphanum('username');
$nNumDots=$oUserData->get_int('numdots',3,20);
$nPattern=$oUserDAta->get_regextext('pattern','/^[0-9|]+$/');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="authonthemove.css" rel="stylesheet" type="text/css">
    <body>
<h1>Enrollment Complete</h1>
<p>
You enrolled into our system. You submitted the following information:
</p>
<table>
    <tr><td>Username:</td><td><?php safe_out($_POST['username'] ?></td></tr>
    <tr><td>Grid Size:</td><td><?php safe_out($_POST['numdots'] ?></td></tr>
    <tr><td>Pattern:</td><td><?php safe_out($_POST['pattern'] ?></td></tr>
</table>
    </body>
</html>
