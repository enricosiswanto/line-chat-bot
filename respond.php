<?php
/** This is a PHP script for handling events from LINE Messaging API, 
 * 
 * @copyright Copyright (c) 2018, Enrico Siswanto
 * @version 1.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

    require_once('line.php');
    
    $channelToken = ''; //Put your line channel token here
    $channelSecret = ''; //Put your channel secret here

    $bot = new lineBot($channelToken, $channelSecret); // Create object for lineBot class function

    if($bot->getEventType()=='message'){ // Event when users sending a message to your line bot
        if($bot->getMsgType()=='text'){ // Determine if user send a text message
            if($bot->getMsgText()=='hi'){ // Getting text messsage
                // Create reply in array variable
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

            $bot->replyMessage($reply); // Function for sending reply message to user
        }
        else if($bot->getMsgType()=='location'){ // Determine if user share a location message
            // Use function getLocTitle() to get Location Title
            // Use function getLocAddress() to get Location Address
            // Use function getLocLatitude() to get Location Latitude
            // Use function getLocLongitude() to get Location Longitude
        }
    }
    else if($bot->getEventType()=='follow'){ // Event when user add or unblock your line bot
        // Put your action here
    }
    else if($bot->getEventType()=='unfollow'){ // Event when user unfriend or block your line bot
        // Put your action here
    }
?>