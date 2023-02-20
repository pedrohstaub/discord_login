<?php

if (!isset($_GET['code'])) {
    echo "error, no code";
    exit;
}

//first we get the code and require user data
$discord_code = $_GET['code'];

$payload = [
    'code' => $discord_code,
    'client_id' => '1077215236798558218',
    'client_secret' => 'HlvOJmAly4u8iOswJo60PXgNEmdYaVas',
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://localhost:1201/src/proccess-oauth.php',
    'scope' => 'identify%20guids',
];

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $discord_token_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); //localhost doesn't need a ssl certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //localhost doesn't need a ssl certificate

$return = curl_exec($curl);


//then check if user data is valid
$return = json_decode($return, true);

$access_token = $return['access_token'];

$discord_usr_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_URL, $discord_usr_url);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); //localhost doesn't need a ssl certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //localhost doesn't need a ssl certificate

$return = curl_exec($curl);

$return = json_decode($return, true);

//after redirect to post login
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['userData'] = [
    'name' => $return['username'],
    'discord_id' => $return['id'],
    'avatar' => $return['avatar']
];

header("Location: finished_login.php");
exit;
