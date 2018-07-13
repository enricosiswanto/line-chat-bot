<?php
    class lineBot {
        public function __construct($channelToken, $channelSecret){
            $this->channelToken = $channelToken;
            $this->channelSecret = $channelSecret;
        }

        // Function for getting message from users
        private function getData(){
            // Get RAW data from POST
            $httpRequestBody = file_get_contents('php://input');
            
            // Compare X-Line-Signature request header string and the signature
            $hash = hash_hmac('sha256', $httpRequestBody, $this->channelSecret, true);
            $signature = base64_encode($hash);
            if (!hash_equals($signature, $_SERVER['HTTP_X_LINE_SIGNATURE'])) {
                http_response_code(400);
                error_log("Invalid signature value");
                exit();
            }

            // Extract RAW JSON data
            $data = json_decode($httpRequestBody, true);
            if (!isset($data['events'])) {
                http_response_code(400);
                error_log("Invalid request body: missing events property");
                exit();
            }
            return $data['events'][0];
        }

        // Function for getting sender profile
        private function getProfile(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.line.me/v2/bot/profile/' . $this->getUserId(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->channelToken,
                ),
            ));
              
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if($err){
                http_response_code(400);
                error_log("Invalid reply message");
                exit();
            }
            return json_decode($response, true);
        }
        
        public function getReplyToken(){
            return $this->getData()['replyToken'];
        }

        public function getTimeStamp(){
            return $this->getData()['timestamp'];
        }

        public function getEventType(){
            return $this->getData()['type'];
        }

        public function getSourceType(){
            return $this->getData()['source']['type'];
        }

        public function getUserId(){
            return $this->getData()['source']['userId'];
        }

        public function getGroupId(){
            return $this->getData()['source']['groupId'];
        }

        public function getRoomId(){
            return $this->getData()['source']['roomId'];
        }

        public function getMsgType(){
            return $this->getData()['message']['type'];
        }

        public function getMsgText(){
            return strtolower($this->getData()['message']['text']);
        }

        public function getDisplayName(){
            return $this->getProfile()['displayName'];
        }

        public function getPictureUrl(){
            return $this->getProfile()['pictureUrl'];
        }

        public function getStatusMessage(){
            return $this->getProfile()['statusMessage'];
        }

        // Function for sending reply message to users
        public function replyMessage($message){
            $message = json_encode($message);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.line.me/v2/bot/message/reply',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $message,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->channelToken,
                ),
            ));
              
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if($err){
                http_response_code(400);
                error_log("Invalid reply message");
                exit();
            }
        }

        // Function for search array in array
        public function arrSearch($arrKey,$arrSearch){
            $result = 0;
            for($i=0;$i<count($arrKey);$i++){
                if(in_array($arrKey[$i],$arrSearch))
                    $result++;
            }

            return $result;
        }
    }
?>