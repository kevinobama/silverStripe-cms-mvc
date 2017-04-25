<?php

class DeviceDetails extends DataObject {
    private static $db = array(

      'device_id' => 'Varchar',
      'app_name' => 'Varchar',
      'app_version' => 'Varchar',
      'device_token' => 'Varchar(1000)',
      'device_model' => 'Varchar',
      'push_badge' => 'Varchar',
      'badge_count' => 'Varchar',
      'push_alert' => 'Varchar',
      'push_sound' => 'Varchar',
      'devicename' => 'Varchar',
      'deviceversion' => 'Varchar',
      'device_os' => "Enum('android,ios')",
      'mode' => "Enum('live,test')",
    );

    static $has_one = array(

        'device_details_ibfk_1' => 'Member',
        'user_id' => 'Member',

    );



}