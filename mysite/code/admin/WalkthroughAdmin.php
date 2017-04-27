<?php   
class WalkthroughAdmin extends ModelAdmin {
    public static $managed_models = array(
        'Walkthrough'
    );

    static $url_segment = 'Walkthrough';

    static $menu_title = 'Walk Through';

}