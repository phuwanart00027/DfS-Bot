<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class BotController extends Controller
{
    public function botNotify(Request $request){
        $httpClient = new CurlHTTPClient('g25x3qWz39fV2KdWySYp/XvYXqyI2QWScXCfsETNWgT+CBMbqB0LmHZWzz2Yi2AYDo1sl6yf5r9pCZ1gjwWlY9fge0k65Bsc5ZvhIK//sX9E66JQZOXujX8Ve+JHEjaLHaD5Htr7Czs/qVHa5KJbLgdB04t89/1O/w1cDnyilFU=');
        $bot = new LINEBot($httpClient, ['channelSecret' => '7665f26dba096fd0e617181e0ee8269f']);

        $events = json_decode($request, true);
        if(!is_null($events)){
            $replyToken = $events->events[0]->replyToken;
        }

        $textMessageBuilder = new TextMessageBuilder(json_encode($events));

        $response = $bot->replyText($replyToken,$textMessageBuilder);
        if ($response->isSucceeded()) {
            return 'Succeeded!';
        }
    }


}
