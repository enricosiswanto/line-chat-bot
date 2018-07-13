<?php
    require_once('line.php');

    $channelToken = ''; //Put your line channel token here
    $channelSecret = ''; //Put your channel secret here

    $bot = new lineBot($channelToken, $channelSecret); //Create object for lineBot class function

    $msgString = explode(' ', $bot->getMsgText());

    if($bot->getEventType()=='message'){ //Event when someone sending a message to your line bot
        if($bot->getMsgType()=='text'){
            if($bot->getMsgText()=='hi'){
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => 'hi too'
                        )
                    )
                );
            }

            $bot->replyMessage($reply); // Function for sending reply message to users
        }
    }
    else if($bot->getEventType()=='follow'){ // Event when users add or unblock your line bot
        // Put your action here
    }
    else if($bot->getEventType()=='unfollow'){ // Event when users unfriend or block your line bot
        // Put your action here
    }
?>