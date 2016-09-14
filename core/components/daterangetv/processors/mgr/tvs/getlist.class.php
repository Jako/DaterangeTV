<?php

/**
 * Get list of Template Variables
 *
 * @package daterangetv
 * @subpackage processor
 */
class DaterangeTVTVsGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modTemplateVar';
    public $languageTopics = array('tagger:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'modTemplateVar';
}

return 'DaterangeTVTVsGetListProcessor';