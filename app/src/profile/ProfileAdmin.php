<?php
use SilverStripe\Admin\ModelAdmin;
class CategoriesAdmin extends ModelAdmin {
    /* ProfileAdmin must have 3 things,
        1. Menu title
        2. URL segment
        3. Managed Model
        */
        private static $menu_title = 'Categories';
        private static $url_segment = 'categories';

        private static $managed_models = [
            ProfileCategory::class
        ];
}