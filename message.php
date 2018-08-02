<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="images/boiddo-band.png" />
    <title>Boiddo | Error</title>
</head>
<body>
<?php
	$msg=$_GET['msg'];
	echo $msg;
	echo "<br/>Cause: Image type miss-match or large file. maximum image size should be less then 128kb.";
?>
</body>