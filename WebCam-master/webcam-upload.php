<?php
	
	//var_dump($_POST['imgBase64']);
	$rawData = $_POST['imgBase64'];
	$user = $_POST['user'];


	$filterData = explode(',',$rawData);
	$unencoded = base64_decode($filterData[1]);
	$fp = fopen('rawData.txt','w');
	fwrite($fp,$rawData );
	fclose($fp);

	$fp = fopen('unnencoded.txt','w');
	fwrite($fp,$unencoded );
	fclose($fp);

	$fp = fopen('filterData.txt','w');
	fwrite($fp,$filterData[1] );
	fclose($fp);

	$datetime = date('Y-M-D').time();

	$fp = fopen($datetime.$user.'.png','w');
	fwrite($fp,$unencoded );
	fclose($fp);

	echo "images/".$datetime.$user.".png";
?>