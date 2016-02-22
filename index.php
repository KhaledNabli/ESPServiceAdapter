<?php


$espRequestUrl = getRequestParameter("espRequestUrl");
$espRequestData = getRequestParameter("espRequestData");



if(empty($espRequestUrl) || empty($espRequestData)) {
	echo "Usage:<br />POST espRequestUrl containing the HTTP PubSub URL to your ESP Window <br /> and espRequestData containing the payload.";
	return;
}



postESPEvent($espRequestUrl, $espRequestData);

return;

function getRequestParameter($parameter) {
	if($_SERVER['REQUEST_METHOD'] == "POST")
		return @$_POST[$parameter];
	else
		return @$_GET[$parameter];
}


function postESPEvent($espRequestUrl, $espRequestData) {

	$options = array(
	    'http' => array(
	        'header'  => "Content-type: JSON\r\n",
	        'method'  => 'POST',
	        'content' => $espRequestData,
	    ),
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($espRequestUrl, false, $context);

	if ($result === FALSE) { /* Handle error */ }
	else {
		echo $result;
	}

} 



?>