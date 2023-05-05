<?php
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

Class ProfileObject extends DataObject {
    
    // Store custom field values in dB
    private static $db = [
        'Titles' => 'Text',
        'Description' =>'Text'
    ];

    // defining new object relationship
    // means that this object file is related to only Profile.php page 
    // $has_one is 1->1 relationship. 'ProfileSource' => File::class means thatProfileObject can have eaxcly 1 file.
    private static $has_one = [
    'ProfileSource' => File::class,
    'Profile' =>Profile::class
    ];

    private static $owns = [
        'ProfileSource'
    ];

    public function getCMSFields() {
        return new FieldList(
            UploadField::create('ProfileSource','Upload image')->setAllowedExtensions(['jpg','jpeg','png']),
            TextField::create('Titles','Enter title'),
            TextareaField::create('Description','Enter Designation')->setRows(4)
        );
    }

}