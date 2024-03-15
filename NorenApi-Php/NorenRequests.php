<?php

// Function to make a POST request using cURL
function makePostRequest($url, $data) {
    $ch = curl_init($url);


    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    if ($result === FALSE) {
        return "Error making the request: " . curl_error($ch);
    }

    curl_close($ch);
    return $result;
}

function bytesToHex($hash) {
    $hexString = '';
    foreach ($hash as $byte) {
        $hex = dechex($byte);
        $hexString .= (strlen($hex) === 1) ? '0' . $hex : $hex;
    }
    return $hexString;
}

function sha256($input) {
    try {
        $digest = hash('sha256', $input, true);
        $encodedhash = array_map('ord', str_split($digest));
        return bytesToHex($encodedhash);
    } catch (Exception $ex) {
        return $input;
    }
}
?>