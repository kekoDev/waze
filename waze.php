<?php
function kexxxx($path, $k)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://rtproxy-row.waze.com/rtserver/distrib/' . $path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $k);
    $headers = array();
    $headers[] = 'Host: rtproxy-row.waze.com';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'User-Agent: 4.92.0.3';
    $headers[] = 'Sequence-Number: 30';
    $headers[] = 'X-Waze-Network-Version: 3';
    $headers[] = 'X-Waze-Wait-Timeout: 3500';
    $headers[] = 'Content-Type: binary/octet-stream';
    $headers[] = 'Cookie: rtserver-id=3986';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}
while (true) {
    $result = kexxxx("login", "ProtoBase64,yj7pAsKIAeQCCOoBGgg0LjkyLjAuMyIMqAbB9L8wsAbiucABKgZYaWFvbWkyB1pTNjYxS1NaCDEwLVNESzI5eACCAQJlbooBJDAzMTM3N2MxLWQxODAtNGQ2Zi1iMWI0LWJmM2JhNjdmYTdjYZABMpgBAbIBFQoTCgt1aWRfZW5hYmxlZBIEdHJ1ZboBnwFNb3ppbGxhLzUuMCAoTGludXg7IEFuZHJvaWQgMTA7IFpTNjYxS1MgQnVpbGQvUUtRMS4xOTA4MjUuMDAyOyB3dikgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgVmVyc2lvbi80LjAgQ2hyb21lLzExMC4wLjU0ODEuNjUgTW9iaWxlIFNhZmFyaS81MzcuMzbCAQgIAhC4CBiiEcoBAmVu0gEkZjQxZTEyMDAtNjVmZi00YzU5LTg1ZmQtZjZkYzFiN2YzNDBi4AHs9tL57DA=\nLogin,world_w7a3uv26,j9d9g191,,3,0,1678339258,normal,F\nProtoBase64,yj4s4oMBKAokOTk1ZjYyNDMtZDZiNC00NTkxLTg3YmYtZjQ4NGRhNWFlN2U3EAA=\nSuggestNavigation,101710401,3153122,0");
    $id = explode(",", $result)[1];
    if (empty($id)) {
        continue;
    }
    $cookies = explode("\n", explode(",", $result)[2])[0];
    echo $id . ":" . $cookies . "\n";
    for ($i = 0; $i < 3; $i++) {
        echo kexxxx("command", "UID,$id,$cookies,234 \nReportAlert,1,DMZ,1,,F,F,,2,,0,101.70" . rand(1000, 9447) . ",3.15" . rand(1000, 9447) . ",0,300,2,262295554,151159919,23,-1,101.70" . rand(1000, 9447) . ",3.15" . rand(1000, 9447) . ",0.000065,0,2,DEFAULT");
        echo "\n";
    }
}
