<?php
/**
 * Abstract get list processor
 *
 * @package daterangetv
 * @subpackage processors
 */

namespace TreehillStudio\DaterangeTV\Processors;

use modObjectGetListProcessor;
use modX;
use TreehillStudio\DaterangeTV\DaterangeTV;
use xPDOQuery;

/**
 * Class ObjectGetListProcessor
 */
class ObjectGetListProcessor extends modObjectGetListProcessor
{
    public $languageTopics = ['daterangetv:default'];

    /** @var DaterangeTV $daterangetv */
    public $daterangetv;

    protected $search = [];
    protected $nameField = 'name';

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    public function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        $this->daterangetv = $this->modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/');
    }

    /**
     * Get a boolean property.
     * @param string $k
     * @param mixed $default
     * @return bool
     */
    public function getBooleanProperty($k, $default = null)
    {
        return ($this->getProperty($k, $default) === 'true' || $this->getProperty($k, $default) === true || $this->getProperty($k, $default) === '1' || $this->getProperty($k, $default) === 1);
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeQuery()
    {
        if ($this->getProperty('valuesqry')) {
            $this->setProperty('limit', 0);
        }

        return parent::beforeQuery();
    }

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $valuesQuery = $this->getProperty('valuesqry');
        $query = (!$valuesQuery) ? $this->getProperty('query') : '';
        if (!empty($query)) {
            $conditions = [];
            $or = '';
            foreach ($this->search as $search) {
                $conditions[$or . $search . ':LIKE'] = '%' . $query . '%';
                $or = 'OR:';
            }
            $c->where([$conditions]);
        }

        return $c;
    }

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c)
    {
        $valuesQuery = $this->getProperty('valuesqry');
        $id = (!$valuesQuery) ? $this->getProperty('id') : $this->getProperty('query');
        if (!empty($id)) {
            $c->where([
                $this->classKey . '.id:IN' => array_map('intval', explode('|', $id))
            ]);
        }

        return $c;
    }

    /**
     * {@inheritDoc}
     * @param array $list
     * @return array
     */
    public function beforeIteration(array $list)
    {
        if (!$this->getProperty('id') && $this->getBooleanProperty('combo', false)) {
            $empty = [
                'id' => 0,
                $this->nameField => $this->modx->lexicon('ext_emptygroup')
            ];
            $list[] = $empty;
        }

        return $list;
    }
}
