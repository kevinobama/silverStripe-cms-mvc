<?php
use Lame\Lame;
use Lame\Settings;

class RESTfulAPIV2 extends Controller
{
    private static $allowed_actions = array('faskcreate','walkthrough');

    public function walkthrough(SS_HTTPRequest $r)
    {
        $json['Text'] = null;
        $walkthrough = Walkthrough::get()->byID(1);
        if($walkthrough && $walkthrough->Text) {
            $json['Text'] = $walkthrough->Text; 
        }
        
        return new SS_HTTPResponse(Convert::array2json($json), 200);        
    }
}
