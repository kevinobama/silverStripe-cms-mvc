<?php
use Lame\Lame;
use Lame\Settings;

class RESTfulAPIV2 extends Controller
{
    private static $allowed_actions = array('walkthrough');

    public function walkthrough(SS_HTTPRequest $r)
    {
        $limit = 100;
        $json['walkthroughs'] = array();
        $walkthroughs = Walkthrough::get()
            ->filter(array('Page' => 'all'))
            ->sort('Sort', 'ASC')
            ->limit($limit);

        foreach($walkthroughs as $walkthrough) {
            $json['walkthroughs'][] = array(
                'ID'           => $walkthrough->ID,
                'Text'         => $walkthrough->Text
            );
        }

        return new SS_HTTPResponse(Convert::array2json($json), 200);
    }
}
