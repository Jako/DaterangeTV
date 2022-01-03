<?php
/**
 * Get list processor for DaterangeTV
 *
 * @package daterangetv
 * @subpackage processors
 */

class DaterangeTVTVsGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modTemplateVar';
    public $languageTopics = array('daterangetv:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'modTemplateVar';

    /**
     * {@inheritDoc}
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c)
    {
        $id = $this->getProperty('id');
        if (!empty($id)) {
            $c->where(array(
                'id:IN' => array_map('intval', explode('|', $id))
            ));
        }
        return $c;
    }

    /**
     * {@inheritDoc}
     * @return array
     */
    public function beforeIteration(array $list)
    {
        if (!$this->getProperty('id')) {
            $empty = array(
                'id' => 0,
                'name' => '(' . $this->modx->lexicon('daterangetv.none') . ')'
            );
            $list[] = $empty;
        }

        return $list;
    }
}

return 'DaterangeTVTVsGetListProcessor';
