<?php
class LiveChat extends DataObject  {

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    private static $db = array(
        'Text' => 'Text',
    );

    private static $has_one = array(
        'Member' => 'Member',
    );
}