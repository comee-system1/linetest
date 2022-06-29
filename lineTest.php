<?php
$LINE_PUSH_URL = "https://api.line.me/v2/bot/message/push";
$LINE_CHANNEL_ACCESS_TOKEN = 'oYI5ZPXN/0IYfI9HoxX95u05FoD1ytJK9TOrCd+vQmmQ/fvShQlNIWGGV+OFua/lM10jUr8g9vhyNoV6Mx6ZRIFtEv9qZ5WoNt0ZukTJy4DZDYfeWXqjeBIMNurGubqD8Ns4DWInAGIw8UB5HyTnEgdB04t89/1O/w1cDnyilFU=';
$LINE_USER_ID = "U357ea4e3178345d5cb4f67a7045f2d41";

   // 送信するメッセージ
   $message_1 = "こんにちは API";
   $message_2 = "PHPからPUSH送信\r\n改行して２行目";

   // リクエストヘッダ
   $header = [
       'Authorization: Bearer ' . $LINE_CHANNEL_ACCESS_TOKEN,
       'Content-Type: application/json'
   ];

   // 送信するメッセージの下準備
   $post_values = array(
       [
       "type" => "text",
       "text" => $message_1
       ],
       [
       "type" => "text",
       "text" => $message_2
       ]
   );

   // 送信するデータ
   $post_data = [
       "to" => $LINE_USER_ID,
       "messages" => $post_values
       ];

   // デバグ確認用のログ：送信データ
   $file = 'post_data.txt';
   file_put_contents($file, json_encode($post_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), FILE_APPEND);
   file_put_contents($file, PHP_EOL.PHP_EOL, FILE_APPEND);

   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $LINE_PUSH_URL);
   curl_setopt($curl, CURLOPT_POST, true);
   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
   curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
   $result = curl_exec($curl);
   curl_close($curl);
