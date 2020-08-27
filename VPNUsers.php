<?php


//Configuraton
$apikey = "<set API KEY HERE>";
$fgip = "<Set Firewall IP HERE>";

//Check if a user needs disconnected
if ($_POST) {
        $kickindex = $_POST['userindex'];
        $apikick = "https://" . $fgip . ":443/api/v2/monitor/vpn/ssl/delete?access_token=" . $apikey;

        //$content = json_encode($fields);
        $content = '{ "type": "websession", "index": ' . $kickindex . '}';

        $curl = curl_init($apikick);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("accept: application/json,Content-Type: application/x-www-form-urlencoded"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        //if ( $status != 201 ) {
        //    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        //}

        curl_close($curl);

        $response = json_decode($json_response, true);

}

//Get List of current users
$apicall = "https://" . $fgip . ":443/api/v2/monitor/vpn/ssl?access_token=" . $apikey . "";

// create curl session
$ch = curl_init();

// set user agent header
curl_setopt(CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');

curl_setopt($ch, CURLOPT_HEADER, 0);

// set our url
curl_setopt($ch, CURLOPT_URL, $apicall);

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// ignore SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

// $output contains the output string
$output = curl_exec($ch);

// close curl
curl_close($ch);

//echo $output;

$response = json_decode($output, true);

echo "<h1>Current VPN Users:</h1>";
echo "<table border='1'><tr><th>Disconnect</th><th>Username</th></tr>";

foreach($response[results] as $key=>$value){
     $userindex = $value['index'];
     $username = $value['user_name'];
     echo "<tr><td><form method='post' action='" . $_SERVER['PHP_SELF'] . "'><input type='hidden' name='userindex' value=' " . $userindex  . "'><input type='submit' name='submit' value='Disconnect'></form></td><td>" . $username . "</td>$
}

?>
