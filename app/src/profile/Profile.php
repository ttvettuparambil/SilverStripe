<?php
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldComponent;

class Profile extends Page {

    // Means that Profile has multiple of profile objects (acts like repeater field)
    private static $has_many = [
        'ProfileObjects' => ProfileObject::class,
        'ProfileObjects2' => ProfileObject::class,
        'ProfileTextObject' => ProfileTextObject::class
    ];
// Root.Main means create it in the corresponding edit page itself.
// FieldList is used to group multiple fields
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',GridField::create(
                    'ProfileObjects',
                    'Profile Data',
                    $this->ProfileObjects(),
                    GridFieldConfig_RecordEditor::create()
        ));

        $fields->addFieldToTab('Root.Main',GridField::create(
                    'ProfileTextObject',
                    'Page Text',
                    $this->ProfileTextObject(),
                    GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}
// $fields->addFieldToTab('Root.Main',GridField::create(
//     'ProfileObjects2',
//     'Profile Data 2',
//     $this->ProfileObjects(),
//     GridFieldConfig_RecordEditor::create()
// ));