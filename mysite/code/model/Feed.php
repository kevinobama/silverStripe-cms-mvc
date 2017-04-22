<?php
	class Feed extends DataObject  {

		private static $db = array(
	        'Text' => 'Text',
	       	'OnBook' => 'Boolean',
	        'OnTop' => 'Boolean',
	        'Selected' => 'Boolean',
	        'Pending' => 'Boolean',
	        'Ranking' => 'Int',
	        'RankingFive' => 'Int',
	        'Sticky' => 'Boolean',
            'Read' => 'Boolean',
	    );

	    private static $has_one = array(
	        'Star' => 'Member', 
	        'Member' => 'Member', 
	    );


	    private static $defaults = array(
	        'Ranking' => 999,
    	);
	}