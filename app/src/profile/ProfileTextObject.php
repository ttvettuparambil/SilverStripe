<?php
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

Class ProfileTextObject extends DataObject {
    // Store custom field values in dB
    private static $db = [
        'Contents' => 'Text'
    ];

    private static $has_one = [
        'Profile' =>Profile::class
    ];

    public function getCMSFields() {
        return new FieldList(
            TextareaField::create('Contents','Enter Page Content')->setRows(5)
                
        );
    }
}