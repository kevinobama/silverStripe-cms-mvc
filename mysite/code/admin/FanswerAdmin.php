<?php   
class FanswerAdmin extends ModelAdmin {
    public static $managed_models = array(
        'Fanswer'
    );

    static $url_segment = 'fanswer';

    static $menu_title = 'Fan Answer';

    public function getList() {
        $list = parent::getList();
        	
        return $list;
    }
}
