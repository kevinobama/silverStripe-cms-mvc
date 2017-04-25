<?php

class Category extends DataObject {
    private static $db = array(
        'Title' => 'Varchar',
        'Description' => 'Text',
        'Active' => 'Boolean'
    );

    private static $has_one = array(
        'ImageCategory' => 'Image',
    );

    private static $belongs_many_many = array(
        'Star' => 'Star'
    );
}