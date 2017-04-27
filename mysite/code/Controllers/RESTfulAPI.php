<?php
use Lame\Lame;
use Lame\Settings;

class RESTfulAPI extends Controller
{
    private static $allowed_actions = array('fask', 'fanswer','faskcreate');

    public function fask(SS_HTTPRequest $r)
    {
    	$fasks = Fask::get()->limit(10);
    	foreach($fasks as $fask) {
			$json['data'][$fask->ID] = $fask->Text;
		}

        return new SS_HTTPResponse(Convert::array2json($json), 200);
    }

    public function faskcreate(SS_HTTPRequest $r)
    {
    	$fasks = Fask::get()->limit(10);
    	foreach($fasks as $fask) {
			$json['data'][$fask->ID] = $fask->Text;
		}

        return new SS_HTTPResponse(Convert::array2json($json), 200);
    }
}
