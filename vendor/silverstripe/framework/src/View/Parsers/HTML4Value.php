<?php

namespace SilverStripe\View\Parsers;

use SilverStripe\Dev\Deprecation;

/*
 * @deprecated 4.13.0 Will be removed without equivalent functionality to replace it
 */
class HTML4Value extends HTMLValue
{
    public function __construct($fragment = null)
    {
        Deprecation::withNoReplacement(function () {
            Deprecation::notice(
                '4.13.0',
                'Will be removed without equivalent functionality to replace it',
                Deprecation::SCOPE_CLASS
            );
        });
        parent::__construct($fragment);
    }

    /**
     * @param string $content
     * @return bool
     */
    public function setContent($content)
    {
        // Ensure that \r (carriage return) characters don't get replaced with "&#13;" entity by DOMDocument
        // This behaviour is apparently XML spec, but we don't want this because it messes up the HTML
        $content = str_replace(chr(13), '', $content ?? '');

        // Reset the document if we're in an invalid state for some reason
        if (!$this->isValid()) {
            $this->setDocument(null);
        }

        $errorState = libxml_use_internal_errors(true);
        $result = $this->getDocument()->loadHTML(
            '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head>' . "<body>$content</body></html>"
        );
        libxml_clear_errors();
        libxml_use_internal_errors($errorState);
        return $result;
    }
}
