<?php
    require_once('line.php');

    $channelToken = 'wLgVttQwMHxVaOjLbE4VHafQ5gyjPUGKlmUa/UDHIJtW9CZp79lLoUtT7zFae8hpKuNTyLP/13H9HHtevIhl1Pfqc9xBxRN73cXJ9HXQHET/pLbSOZ8fTgUaFbSkrvZWnWQ3wRg00h5QBWP+X4Ke+AdB04t89/1O/w1cDnyilFU=';
    $channelSecret = '315b2affec470816ddbc7c9acc2e31cd';

    $bot = new lineBot($channelToken, $channelSecret);

    $msgString = explode(' ', $bot->getMsgText());

    if($bot->getEventType()=='message'){
        if($bot->getMsgType()=='text'){
            if(in_array('halo',$msgString) || in_array('hi',$msgString) || in_array('hai',$msgString)){
                $text = 'Halo '.$bot->getDisplayName().'..:)';
                $text2 = 'Ternyata kamu ok juga yah';
                $text3 = 'Boleh tau alamat rumah kamu gak?';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        ),
                        array(
                            'type' => 'text',					
                            'text' => $text2
                        ),
                        array(
                            'type' => 'sticker',					
                            'packageId' => '2',
                            'stickerId' => '172'
                        ),
                        array(
                            'type' => 'text',					
                            'text' => $text3
                        )
                    )
                );
            }
            else if($bot->arrSearch(array('goblok','tolol','bego','bangsat','jelek','bodoh'),$msgString)>0){
                $text = 'Kok kamu kasar banget siih, aku jadi sedih';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        ),
                        array(
                            'type' => 'sticker',					
                            'packageId' => '2',
                            'stickerId' => '524'
                        )
                    )
                );
            }else if($bot->arrSearch(array('goblok','tolol','bego','bangsat','jelek','bodoh'),$msgString)>0){
                $text = 'Kok kamu kasar banget siih, aku jadi sedih';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        ),
                        array(
                            'type' => 'sticker',					
                            'packageId' => '2',
                            'stickerId' => '524'
                        )
                    )
                );
            }else if($bot->arrSearch(array('goblok','tolol','bego','bangsat','jelek','bodoh'),$msgString)>0){
                $text = 'Kok kamu kasar banget siih, aku jadi sedih';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        ),
                        array(
                            'type' => 'sticker',					
                            'packageId' => '2',
                            'stickerId' => '524'
                        )
                    )
                );
            }
            else if($bot->arrSearch(array('cantik','ayu','manis','cakep','imut','lucu'),$msgString)>0){
                $text = 'Thank you yah pujiannya :)';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        )
                    )
                );
            }
            else if(in_array('nama',$msgString)){
                $pos1 = array_search('nama',$msgString);
                if($msgString[$pos1+1]=='aku' || $msgString[$pos1+1]=='saya' || $msgString[$pos1+1]=='aku?' || $msgString[$pos1+1]=='saya?')
                    $text = 'Nama kamu kan '.$bot->getDisplayName().'. Masa kamu lupa sih :)';
                else if($msgString[$pos1+1]=='kamu' || $msgString[$pos1+1]=='kamu?' || $msgString[$pos1+1]=='lu' || $msgString[$pos1+1]=='loe')
                    $text = 'Nama aku Kathleen :)';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        )
                    )
                );
            }
            else if(in_array('kencan',$msgString)){
                $json = json_decode('{
                    "type": "template",
                    "altText": "Pilih tempat kencan",
                    "template": {
                      "type": "carousel",
                      "actions": [],
                      "columns": [
                        {
                          "thumbnailImageUrl": "https://umn.web.id/chatbot/kencan.jpg",
                          "title": "Kamu lebih suka yang mana?",
                          "text": "Aku udah pilihin 2 tempat asyik nih buat kencan",
                          "actions": [
                            {
                              "type": "message",
                              "label": "Negev Gastronomy Art",
                              "text": "Negev Gastronomy Art"
                            },
                            {
                              "type": "message",
                              "label": "Henshin",
                              "text": "Henshin"
                            }
                          ]
                        }
                      ]
                    }
                  }');
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array($json)
                );
            }
            else{
                $text = 'Mohon maaf aku tidak mengerti maksud kamu :(';
                $reply = array(
                    'replyToken' => $bot->getReplyToken(),														
                    'messages' => array(
                        array(
                            'type' => 'text',					
                            'text' => $text
                        )
                    )
                );
            }
        }
    }
    else if($bot->getEventType()=='follow'){
        $text = 'Thank you yahh udah mau jadi temennya Kathleen :)';
        $reply = array(
            'replyToken' => $bot->getReplyToken(),														
            'messages' => array(
                array(
                    'type' => 'text',					
                    'text' => $text
                )
            )
        );
    }
    else if($bot->getEventType()=='unfollow'){
      
    }

    $result =  json_encode($reply);
    file_put_contents('./reply.json',$result);
    $bot->replyMessage($reply);
?>