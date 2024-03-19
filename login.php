<?php
include 'NorenRoutes.php';
include 'NorenRequests.php';



$Password = sha256('Password@123');          #password of investor user.
$appkey=sha256('USERID|test123api');   #uid|vendorkey

$jData = [
    "apkversion" => "1.0.9",
    "uid" => "USERID",
    "pwd" => $Password,
    "factor2" => "01-01-1970",
    "imei" => "ag3tbbbb33",
    "source" => "API",
    "vc" => "Vendor_Code",
    "appkey" => $appkey
];

// Encode the data as JSON
$jsonData = json_encode($jData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$jsonData = "jData=" . $jsonData;

// Make a POST request to the login endpoint
$loginEndpoint =$norenRoutes->getFullUrl('authorize');; // Replace with your actual API endpoint

try {
    // Make a POST request to the login endpoint
    $response = makePostRequest($loginEndpoint, $jsonData);
    echo "$loginEndpoint" . PHP_EOL;
    echo "$jsonData" . PHP_EOL;

    echo "***********************************************************************" . PHP_EOL;

    // Print the response
    echo $response .PHP_EOL;;
    // Decode the JSON response
    $responseData = json_decode($response, true);
        // Check if "susertoken" exists in the response
        if (isset($responseData['susertoken'])) {
        // Store the "susertoken" in a variable
        $susertoken = $responseData['susertoken'];
        // Data to be written to the file
        $data =  $susertoken;

        // File path
        $filePath = "Example/susertoken.txt";

        // Write data to the file
        file_put_contents($filePath, $data); // Use FILE_APPEND to append data to the file
        // Print or use the susertoken as needed
        echo "susertoken :$susertoken written to the susertoken.txt file." .PHP_EOL;;
        
        } else {
            echo "Susertoken not found in the response";
        }
        // $variableValue = $susertoken;
        // header("Location:test_placeorder.php?var=$variableValue");

} catch (Exception $e) {
    // Handle the exception and print the error message
    echo 'Caught exception: ', $e->getMessage(), "\n";
}

?>
