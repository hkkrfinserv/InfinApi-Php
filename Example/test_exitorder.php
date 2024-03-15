<?php

require_once '../vendor/autoload.php'; // Autoload Composer dependencies
include '../NorenRoutes.php';
include '../NorenRequests.php';


echo "*********************************************************************" . PHP_EOL;

$jData = [
    "uid" => "NIKHESHP",
    "norenordno" =>  "24031300000072",
    "prd" =>  "H",
];

$filePath = "susertoken.txt";

// Read data from the file
$susertoken = file_get_contents($filePath);

// Output the contents
echo "susertoken: " . $susertoken . PHP_EOL;

// Encode the data as JSON
$jsonData = json_encode($jData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$jsonData = "jData=" . $jsonData . "&jKey=" . $susertoken;


// Make a POST request to the login endpoint
$loginEndpoint =$norenRoutes->getFullUrl('cancelorder'); // Replace with your actual API endpoint

try {
    // Make a POST request to the login endpoint
    $response = makePostRequest($loginEndpoint, $jsonData);
    echo "$loginEndpoint" . PHP_EOL;
    echo "$jsonData" . PHP_EOL;

    echo "*********************************************************************" . PHP_EOL;

    $responseData = json_decode($response, true);
    // Check if "susertoken" exists in the response
    if (isset($responseData['emsg']) && $responseData['emsg'] =="Session Expired :  Invalid Session Key") {
        // Store the "susertoken" in a variable
        $emsg = $responseData['emsg'];
        echo "Session Expired : Please run login.php again" . PHP_EOL;
    } else {
        // Code to execute if the condition is false
        echo $response .PHP_EOL;
    }
    
    
} catch (Exception $e) {
    // Handle the exception and print the error message
    echo 'Caught exception: ', $e->getMessage(), "\n";
}  

?>

