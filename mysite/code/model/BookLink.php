<?php

    class BookLink extends DataObject {

         private static $db = array(
            'Text' => 'Varchar',
            'URL' => 'Varchar',
            'Apple_Platform' => 'Boolean',
            'Google_Platform' => 'Boolean',
            'SortOrder' => 'Int'
        );

         private static $belongs_many_many = array(
            "Book" => "Book"
         );

         private static $defaults = array(
            'SortOrder' => '1',
        );

         public static $summary_fields = array(
            'URL' => 'URL',
            

        );
      
    }