<?php
/**
 * Get list processor for DaterangeTV
 *
 * @package daterangetv
 * @subpackage processor
 */

class DaterangeTVTVsGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modTemplateVar';
    public $languageTopics = array('daterangetv:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'modTemplateVar';
}

return 'DaterangeTVTVsGetListProcessor';
