<?php

class PushNotification extends DataObject {
    private static $db = array(
      'NotificationTitle' => 'Varchar(255)',
      'NotificationMessage' => 'Varchar(1024)'
    );

    /* public function getCMSFields() {
    	$fields = parent::getCMSFields();  
       
        $fields->addFieldToTab('Root.Main', TextField::create('NotificationTitle', 'Title'));
        $fields->addFieldToTab('Root.Main', TextField::create('NotificationMessage', 'Message'));

        return $fields;
    } */

     function onAfterWrite() {
         parent::onAfterWrite();
         Debug::show($this->NotificationTitle);
         Debug::show($this->NotificationMessage);
         Debug::show($this->ID);

        $android_devices = DeviceDetails::get()->filter('device_os', 'android')->first();
        $ios_devices = DeviceDetails::get()->filter('device_os', 'ios')->first();

        if(count($android_devices) > 0) {
            $data = array(
                        'title' => $this->NotificationTitle,
                        'message' => $this->NotificationMessage,
                        'id' => '1',
                        'type' => 'general',
                        'vibrate' => 1,
                        'sound' => 1,
                    ); 
            foreach($android_devices AS $details) {
                $GOOGLE_API_KEY = 'AIzaSyDAyUEfUn1N7Qfn66yKiqrETNbxiB2GJQE';
                $url = 'https://android.googleapis.com/gcm/send';
                $headers = array(
                    'Authorization: key=' . $GOOGLE_API_KEY,
                    'Content-Type: application/json'
                );
                $data['badge'] = '1';

                echo $details->device_token;
                $fields = array(
                    'registration_ids' => array($details->device_token),
                    'data' => $data,
                );

                // Open connection
                $ch = curl_init();
                // Set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                // Execute post
                $result = curl_exec($ch);

                if ($result === FALSE) {
                    die('Curl failed: ' . curl_error($ch));
                }

                // Close connection
                curl_close($ch);
            }
        }
        if(count($ios_devices) > 0) {
            $data = array(
                        'title' => $this->NotificationTitle,
                        'message' => $this->NotificationMessage,
                        'id' => '1',
                        'type' => 'general',
                        'vibrate' => 1,
                        'sound' => 1,
                    ); 
            foreach($ios_devices AS $details) {
                $ck_path = realpath(dirname(__FILE__)). '/' . "ck.pem";
                $url = "ssl://gateway.push.apple.com:2195";
                if ($details->mode === 'test') {
                    $ck_path = realpath(dirname(__FILE__)).'/'. "ck_dev.pem";
                    $url = 'ssl://gateway.sandbox.push.apple.com:2195';
                }
                var_dump($ck_path);

                $passphrase = 'sk123456';
                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', $ck_path);
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                $body['aps'] = array(
                    'alert' => $data['title'],
                    'sound' => 'default'
                );
                $body ['message'] = $data['message'];
                $body ['id'] = $data['id'];
                $body ['type'] = $data['type'];
                $body ['badge'] = '1';

                $payload = json_encode($body);

                $fp = stream_socket_client( $url, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                if (!$fp) {
                    exit("Failed to connect: $err $errstr" . PHP_EOL);
                }
                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', $details->device_token) . pack('n', strlen($payload)) . $payload;
                // Send it to the server
                $result = fwrite($fp, $msg, strlen($msg));
                // Close the connection to the server
                fclose($fp);
            }
        }
    }


    }