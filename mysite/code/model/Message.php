<?php

class Message extends DataObject {
    private static $db = array(
        'Text' => 'Text',
        'Read' => 'Boolean'
    );

    static $has_one = array(
        'MemberFrom' => 'Member',
        'MemberTo' => 'Member',
        'Message' => 'Message'
    );

    static $has_many = array(
        'ReplyMessages' => 'Message',

    );

}