<?php
/**
 * Get list Template Variables
 *
 * @package daterangetv
 * @subpackage processors
 */

use TreehillStudio\DaterangeTV\Processors\ObjectGetListProcessor;

class DaterangeTVTVsGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'modTemplateVar';
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'daterangetv.templatevar';

    protected $search = ['name'];
}

return 'DaterangeTVTVsGetListProcessor';
