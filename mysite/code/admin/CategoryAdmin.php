<?php   
class CategoryAdmin extends ModelAdmin {
    public static $managed_models = array(
        'Category'
    );

    static $url_segment = 'category';

    static $menu_title = 'Categorie Star';


}