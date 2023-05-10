<?php

namespace SilverStripe\Admin;

use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\FileField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Security\Group;
use SilverStripe\Security\GroupCsvBulkLoader;
use SilverStripe\Dev\Deprecation;

/**
 * Imports {@link Group} records by CSV upload, as defined in
 * {@link GroupCsvBulkLoader}.
 * @deprecated 1.13.0 Will be removed without equivalent functionality to replace it
 */
class GroupImportForm extends Form
{
    /**
     * @var Group Optional group relation
     */
    protected $group;

    public function __construct($controller, $name, $fields = null, $actions = null, $validator = null)
    {
        Deprecation::withNoReplacement(function () {
            Deprecation::notice('1.13.0', 'Will be removed without equivalent functionality to replace it', Deprecation::SCOPE_CLASS);
        });
        if (!$fields) {
            $helpHtml = _t(
                __CLASS__ . '.Help1',
                '<p>Import one or more groups in <em>CSV</em> format (comma-separated values).'
                . ' <small><a href="#" class="toggle-advanced">Show advanced usage</a></small></p>'
            );

            $importer = new GroupCsvBulkLoader();
            $importSpec = $importer->getImportSpec();

            $columns = implode(', ', array_keys($importSpec['fields'] ?? []));
            $helpHtml .= _t(
                __CLASS__ . '.Help2',
                '<div class="advanced">'
                . '<h4>Advanced usage</h4>'
                . '<ul>'
                . '<li>Allowed columns: <em>{columns}</em></li>'
                . '<li>Existing groups are matched by their unique <em>Code</em> value, and updated with any new values from the '
                . 'imported file</li>'
                . '<li>Group hierarchies can be created by using a <em>ParentCode</em> column.</li>'
                . '<li>Permission codes can be assigned by the <em>PermissionCode</em> column. Existing permission codes are not '
                . 'cleared.</li>'
                . '</ul>'
                . '</div>',
                ['columns' => $columns]
            );

            $fields = new FieldList(
                new LiteralField('Help', $helpHtml),
                $fileField = new FileField(
                    'CsvFile',
                    DBField::create_field('HTMLFragment', _t(
                        MemberImportForm::class . '.FileFieldLabel',
                        'CSV File <small>(Allowed extensions: *.csv)</small>'
                    ))
                )
            );
            $fileField->getValidator()->setAllowedExtensions(['csv']);
        }

        if (!$actions) {
            $action = new FormAction('doImport', _t(MemberImportForm::class . '.BtnImport', 'Import from CSV'));
            $action->addExtraClass('btn btn-outline-secondary font-icon-upload');
            $actions = new FieldList($action);
        }

        if (!$validator) {
            $validator = new RequiredFields('CsvFile');
        }

        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->addExtraClass('cms');
        $this->addExtraClass('import-form');
    }

    public function doImport($data, $form)
    {
        $loader = new GroupCsvBulkLoader();

        // load file
        $result = $loader->load($data['CsvFile']['tmp_name']);

        // result message
        $msgArr = [];
        if ($result->CreatedCount()) {
            $msgArr[] = _t(
                __CLASS__ . '.ResultCreated',
                'Created {count} groups',
                ['count' => $result->CreatedCount()]
            );
        }
        if ($result->UpdatedCount()) {
            $msgArr[] = _t(
                __CLASS__ . '.ResultUpdated',
                'Updated {count} groups',
                ['count' => $result->UpdatedCount()]
            );
        }
        if ($result->DeletedCount()) {
            $msgArr[] = _t(
                __CLASS__ . '.ResultDeleted',
                'Deleted {count} groups',
                ['count' => $result->DeletedCount()]
            );
        }
        $msg = ($msgArr) ? implode(',', $msgArr) : _t(MemberImportForm::class . '.ResultNone', 'No changes');

        $this->sessionMessage($msg, 'good');

        $this->controller->redirectBack();
    }
}
