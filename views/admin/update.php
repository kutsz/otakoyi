<?php
echo 'update' . '<br><br>';
//var_dump($_POST);
$commentid = $_POST['commentid'];
$dateComment = $_POST['dateCom'];
$ip = $_POST['ip'];
$browser = $_POST['browser'];
$textComment = $_POST['textComment'];

foreach ($commentid as $key => $id) {
	echo $id . '<br>';
	echo $dateComment[$key] . '<br>';
	echo $ip[$key] . '<br>';
	echo $browser[$key] . '<br>';
	echo $textComment[$key] . '<br><br>';
}

echo "<br><a href = 'cabinet'>Back to cabinet</a>";