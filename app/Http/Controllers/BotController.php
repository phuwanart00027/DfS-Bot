<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    public function botNotify(){
        $access_token = 'nyYah13xqVYr7kkYCpER2mSRTHlamvnscrfxN/HafqG8EnR3U8jxNB/SIFUNQyRBDo1sl6yf5r9pCZ1gjwWlY9fge0k65Bsc5ZvhIK//sX8nJp5mwNJu1WVBRG1RClWhVMWCzGvC5sGn/rk5W57FuAdB04t89/1O/w1cDnyilFU=';

        // Get POST body content
        $content = file_get_contents('php://input');
        // Parse JSON
        $events = json_decode($content, true);
        // Validate parsed JSON data
        if (!is_null($events['events'])) {
            // Loop through each event
            foreach ($events['events'] as $event) {
                // Reply only when message sent is in 'text' format
                if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
                    // Get text sent
                    $text = $event['message']['text'];
                    // Get replyToken
                    $replyToken = $event['replyToken'];

                    // Build message to reply back
                    // $messages = [
                    //     "type" => "image",
                    //     "previewUrl"=>"http://ehongcontent.esy.es",
                    //     "originalContentUrl" => "https://glacial-reaches-84417.herokuapp.com/PT2.jpg",
                    //     "previewImageUrl"=> "https://glacial-reaches-84417.herokuapp.com/PT2.jpg"
                    // ];

                    // message text
                    $messages = [
                        'type' => 'text',
                        'text' => '5555',
                    ];

                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages],
                    ];
                    $post = json_encode($data);
                    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    echo $result . "\r\n";
                }
            }
        }
        echo "OK";
    }
}
