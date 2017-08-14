<?php


// // Ghi lần đầu
// $path="demo.txt";
// $file=fopen($path, "w");
// $write=fwrite($file,"Hello PHP !\n");
// fclose($file);

// // Ghi tiếp
// $path="demo.txt";
// $file=fopen($path, "a");
// $write=fwrite($file,"Hello PHP Again!\n");
// fclose($file);

zZZzZ


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://web.eyelashs.jp/Procare1/api/login/customers.xml",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n
                        <xml>\n   
                            <auth>\n        
                              <username>M</username>\n 
                              <password>08041320468</password>\n  
                            </auth>\n   
                            <lang>en</lang>\n  
                            <datetime>2017-08-02 16:18:27</datetime>\n 
                            <action>login_customers</action>\n 
                            <device_type>0</device_type>\n   
                            <device_token></device_token>\n
                        </xml>",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: 4a717459-2d5c-c2ba-c6a4-9b805240846c"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}


