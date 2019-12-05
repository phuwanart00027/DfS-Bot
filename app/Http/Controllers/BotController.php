<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    public function botNotify(){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('nyYah13xqVYr7kkYCpER2mSRTHlamvnscrfxN/HafqG8EnR3U8jxNB/SIFUNQyRBDo1sl6yf5r9pCZ1gjwWlY9fge0k65Bsc5ZvhIK//sX8nJp5mwNJu1WVBRG1RClWhVMWCzGvC5sGn/rk5W57FuAdB04t89/1O/w1cDnyilFU=');
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '7665f26dba096fd0e617181e0ee8269f']);

        $content = file_get_contents('php://input');

        $events = json_decode($content, true);
        if(!is_null($events)){
            // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
            $replyToken = $events['events'][0]['replyToken'];
        }

        $textMessageBuilder = new TextMessageBuilder(json_encode($events));

        $response = $bot->replyMessage($replyToken,$textMessageBuilder);
        if ($response->isSucceeded()) {
            return 'Succeeded!';
            // return;
        }
    }
}
