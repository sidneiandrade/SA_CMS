<?php

$url = "https://www.google.com/recaptcha/api/siteverify";

$data = [
    'secret' => "6LcCpN4ZAAAAAG1FNrPpkRVA6Zf97EkLOU9COlqD",
    'response' => $_POST['token'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$res = json_decode($response, true);

header('Content-type: application/json');
echo json_encode($res);

// if($res['success'] == true) {
//     $data = ['recaptcha' => 'true'];
//     header('Content-type: application/json');
//     echo json_encode($data);
// } else {
//     $data = ['recaptcha' => 'false'];
//     header('Content-type: application/json');
//     echo json_encode($data);
// }