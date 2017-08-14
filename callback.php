<?php
session_start();
$accessToken = 'fc0oTVl6156HKVz3FUz8t1nlvC1OpZMYy9IWmSblG1HKEy5bKUI28YqIz70Gbcr0fEYusYUoOAqneRqIPpe4q1ARZ36TwLj+XBQhqXfimafkhHdsW4bXmmTjen9Dpt110AbUy3aEeFJ0PJp9RncxMAdB04t89/1O/w1cDnyilFU=';
 
//Tải tin nhắn người dùng
$json_string = file_get_contents('php://input');
$json_object = json_decode($json_string);
 
//dữ liệu nhận đc
$replyToken = $json_object->{"events"}[0]->{"replyToken"};        
$message_type = $json_object->{"events"}[0]->{"message"}->{"type"};    
$message_text = $json_object->{"events"}[0]->{"message"}->{"text"};    



//thoát nếu tin nhắn không là văn bản
//if($message_type != "text") exit;
 
// if($message_text == "予約" || $message_text == '予約する' ){
       
//         $return_message_text = '携帯番号を入力してください？';        
//            //$return_message_text =  $pass; 
//         if(int($phone)){

//             $return_message_text =  $phone; 
        
//             // //// Ghi lần đầu
//             // $path="demo.php";
//             // $file=fopen($path, "w");
//             // $write=fwrite($file,"xin chao");
//             // fclose($file);
//             //$return_message_text = 'パスワードを入力してください。？';
            
//             $_SESSION['phone']; 
//            // $return_message_text =  $_SESSION['msg']; 
//             if(isset($_SESSION['phone'])){
//                 $return_message_text = 'パスワードを入力してください。？';
//             }
//         }


// }

    //trả lời nhắn
 $return_message_text =  $message_text;   


//Thực hiện trả lời
sending_messages($accessToken, $replyToken, $message_type, $return_message_text);


?>

<?php
//hàm gửi thông tin đi
function sending_messages($accessToken, $replyToken, $message_type, $return_message_text){
    //Định dạng phản hoài
    $response_format_text = [
        "type" => $message_type,
        "text" => $return_message_text
    ];
 
    //Dữ liệu gửi
    $post_data = [
        "replyToken" => $replyToken,
        "messages" => [$response_format_text]
    ];
 
    //curl
    $ch = curl_init("https://api.line.me/v2/bot/message/reply");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $accessToken
    ));
    $result = curl_exec($ch);
    curl_close($ch);
}
?>






















<!-- 
$accessToken = 'jevTMM3B3CkoU0a3VDLCaJkr94vpGFxF+2BRte2XgKTbrdQf8aD3Pbey6fidzEMc/9Zg4L22SrTiMqOTP/8bOBlnpgtGxM7IRVsUvYNBWOO4QwMyEzbs5doL28my/NbZkfjMroBRGkDOepgYE/LCiwdB04t89/1O/w1cDnyilFU=';

$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};



if ($message->{"text"} == '予約' || $message->{"text"} == '予約する' ) {
            // 確認ダイアログタイプ
            $messageData = [
                'type' => 'template',
                'altText' => '予約',
                'template' => [
                    'type' => 'confirm',
                    'text' => '携帯番号を入力してください？',
                    'actions' => [
                        [
                            'type' => 'message',
                            'label' => '元気です',
                            'text' => '元気です'
                        ],
                        [
                            'type' => 'message',
                            'label' => 'まあまあです',
                            'text' => 'まあまあです'
                        ],
                    ]
                ]
            ];      
    }else {
           
    // // trả lời message hiện tại
    $messageData = [
        'type' => 'text',
        'text' => $message->{"text"}
    ];

}

        // //Các loại phản hoài có nội dung
        // if ($message->{"text"} == '確認') {
        //     // 確認ダイアログタイプ
        //     $messageData = [
        //         'type' => 'template',
        //         'altText' => '確認ダイアログ',
        //         'template' => [
        //             'type' => 'confirm',
        //             'text' => '元気ですかー？',
        //             'actions' => [
        //                 [
        //                     'type' => 'message',
        //                     'label' => '元気です',
        //                     'text' => '元気です'
        //                 ],
        //                 [
        //                     'type' => 'message',
        //                     'label' => 'まあまあです',
        //                     'text' => 'まあまあです'
        //                 ],
        //             ]
        //         ]
        //     ];
        // } elseif ($message->{"text"} == 'ボタン') {
        //     // ボタンタイプ
        //     $messageData = [
        //         'type' => 'template',
        //         'altText' => 'ボタン',
        //         'template' => [
        //             'type' => 'buttons',
        //             'title' => 'タイトルです',
        //             'text' => '選択してね',
        //             'actions' => [
        //                 [
        //                     'type' => 'postback',
        //                     'label' => 'webhookにpost送信',
        //                     'data' => 'value'
        //                 ],
        //                 [
        //                     'type' => 'uri',
        //                     'label' => 'googleへ移動',
        //                     'uri' => 'https://google.com'
        //                 ]
        //             ]
        //         ]
        //     ];
        // } elseif ($message->{"text"} == 'カルーセル') {
        //     // カルーセルタイプ
        //     $messageData = [
        //         'type' => 'template',
        //         'altText' => 'カルーセル',
        //         'template' => [
        //             'type' => 'carousel',
        //             'columns' => [
        //                 [
        //                     'title' => 'カルーセル1',
        //                     'text' => 'カルーセル1です',
        //                     'actions' => [
        //                         [
        //                             'type' => 'postback',
        //                             'label' => 'webhookにpost送信',
        //                             'data' => 'value'
        //                         ],
        //                         [
        //                             'type' => 'uri',
        //                             'label' => '美容の口コミ広場を見る',
        //                             'uri' => 'http://clinic.e-kuchikomi.info/'
        //                         ]
        //                     ]
        //                 ],
        //                 [
        //                     'title' => 'カルーセル2',
        //                     'text' => 'カルーセル2です',
        //                     'actions' => [
        //                         [
        //                             'type' => 'postback',
        //                             'label' => 'webhookにpost送信',
        //                             'data' => 'value'
        //                         ],
        //                         [
        //                             'type' => 'uri',
        //                             'label' => '女美会を見る',
        //                             'uri' => 'https://jobikai.com/'
        //                         ]
        //                     ]
        //                 ],
        //             ]
        //         ]
        //     ];
        // }else {
           
        //     // // trả lời message hiện tại
        //     $messageData = [
        //         'type' => 'text',
        //         'text' => $message->{"text"}
        //     ];

        // }

        $post = [
            'replyToken' => $replyToken,
            'messages' => [$messageData]
        ];
        error_log(json_encode($post));



        $ch = curl_init('https://api.line.me/v2/bot/message/reply');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charser=UTF-8',
            'Authorization: Bearer ' . $accessToken
        ));
        $result = curl_exec($ch);
        error_log($result);
        curl_close($ch);

 -->