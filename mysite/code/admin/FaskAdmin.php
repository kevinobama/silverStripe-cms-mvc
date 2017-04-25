<?php   
class FaskAdmin extends ModelAdmin {
    public static $managed_models = array(
        'Fask'
    );

    static $url_segment = 'fask';

    static $menu_title = 'Fan Ask';

}
