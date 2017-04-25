<?php
class LiveChatStar extends LiveChat  {

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    private static $has_one = array(
        'Star' => 'Member',
    );
}