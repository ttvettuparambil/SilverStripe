<?php

namespace themes\simple\PurpleSlider\MySite;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class LatestPageBlock extends BaseElement
{
    private static $singular_name = 'Latest Page Block';

    private static $plural_name = 'Latest Page Blocks';

    private static $description = 'Displays latest page name';

    // private static $icon = 'font-icon-p-book';

    private static $table_name = 'LatestPages';

    private static $db = [

        "WidgetContent" => "HTMLText",
        "NumberToDisplay" => "Int",  
    ];

	public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab("Root.Main",HTMLEditorField::create('WidgetContent,','WidgetContent')->setRows(5), 'NumberToDisplay');

        // ...

        return $fields;
    }

    public function getSummary(): string
    {
        return "hello"; /* some string that represents the data in this element */;
    }

    public function getType()
    {
        return 'Latest Pages';
    }
}