<?php
use SilverSTripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SIlverStripe\Forms\TextField;

Class ProfileCategory extends DataObject {

    private static $db = [
        'ProfileCategoryTitle' => 'Text',

    ];
    // A profile category can be assigned to different profiles and profiles can belong to many categories
    private static $belongs_many_many = [
        'ProfileObjects' => ProfileObject::class
    ];
    public function getCMSFields() {
        return new FieldList(
            TextField::create('ProfileCategoryTitle')
        );
    }

}