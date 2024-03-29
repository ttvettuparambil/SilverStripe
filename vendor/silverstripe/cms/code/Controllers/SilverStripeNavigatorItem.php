<?php

namespace SilverStripe\CMS\Controllers;

use SilverStripe\Dev\Deprecation;
use SilverStripe\ORM\CMSPreviewable;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Security\Member;
use SilverStripe\View\ViewableData;

/**
 * Navigator items are links that appear in the $SilverStripeNavigator bar.
 * To add an item, extend this class - it will be automatically picked up.
 * When instanciating items manually, please ensure to call {@link canView()}.
 *
 * Class have been moved from `silverstripe/cms` to `silverstripe/admin` and renamed.
 * @deprecated Will be renamed SilverStripe\Admin\Navigator\SilverStripeNavigatorItem
 */
abstract class SilverStripeNavigatorItem extends ViewableData
{

    /**
     * @param DataObject|CMSPreviewable
     */
    protected $record;

    /** @var string */
    protected $recordLink;

    public function __construct(CMSPreviewable $record)
    {
        Deprecation::withNoReplacement(function () {
            switch (static::class) {
                // These classes have their own deprecation notice
                case 'SilverStripe\CMS\Controllers\SilverStripeNavigatorItem_ArchiveLink':
                case 'SilverStripe\CMS\Controllers\SilverStripeNavigatorItem_LiveLink':
                case 'SilverStripe\CMS\Controllers\SilverStripeNavigatorItem_StageLink':
                case 'SilverStripe\CMS\Controllers\SilverStripeNavigatorItem_Unversioned':
                // This class is not deprecated and doesn't have a deprecation notice
                case 'SilverStripe\CMS\Controllers\SilverStripeNavigatorItem_CMSLink':
                    break;
                default:
                    Deprecation::notice(
                        '4.13.0',
                        'Will be renamed SilverStripe\Admin\Navigator\SilverStripeNavigatorItem',
                        Deprecation::SCOPE_CLASS
                    );
            }
        });
        parent::__construct();
        $this->record = $record;
    }

    /**
     * @return string HTML, mostly a link - but can be more complex as well.
     * For example, a "future state" item might show a date selector.
     */
    abstract public function getHTML();

    /**
     * @return string
     * Get the Title of an item
     */
    abstract public function getTitle();

    /**
     * Machine-friendly name.
     *
     * @return string
     */
    public function getName()
    {
        return substr(static::class, strpos(static::class, '_') + 1);
    }

    /**
     * Optional link to a specific view of this record.
     * Not all items are simple links, please use {@link getHTML()}
     * to represent an item in markup unless you know what you're doing.
     *
     * @return string
     */
    public function getLink()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return null;
    }

    /**
     * @return DataObject
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->config()->get('priority');
    }

    /**
     * As items might convey different record states like a "stage" or "live" table,
     * an item can be active (showing the record in this state).
     *
     * @return boolean
     */
    public function isActive()
    {
        return false;
    }

    /**
     * Filters items based on member permissions or other criteria,
     * such as if a state is generally available for the current record.
     *
     * @param Member $member
     * @return Boolean
     */
    public function canView($member = null)
    {
        return true;
    }

    /**
     * Counts as "archived" if the current record is a different version from both live and draft.
     *
     * @return boolean
     */
    public function isArchived()
    {
        /** @var Versioned|DataObject $record */
        $record = $this->record;
        if (!$record->hasExtension(Versioned::class) || !$record->hasStages()) {
            return false;
        }

        if (!isset($record->_cached_isArchived)) {
            $record->_cached_isArchived = $record->isArchived();
        }

        return $record->_cached_isArchived;
    }
}
