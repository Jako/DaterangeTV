<?php
/**
 * Abstract Snippet
 *
 * @package daterangetv
 * @subpackage snippet
 */

namespace TreehillStudio\DaterangeTV\Snippets;

use DaterangeTV;
use modX;

/**
 * Class Snippet
 */
abstract class OutputFilter extends Snippet
{
    /**
     * Creates a new OutputFilter instance.
     *
     * @param modX $modx
     * @param array $properties
     */
    public function __construct(modX $modx, $properties = [])
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        /** @var DaterangeTV $daterangetv */
        $this->daterangetv = $this->modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
            'core_path' => $corePath
        ]);

        $this->properties = $this->initProperties($properties);
        if ($this->getProperty('tag')) {
            $options = $this->getProperty('options') ?? [];
            $options['value'] = $this->getProperty('input');
            $this->properties = $this->initProperties(array_merge($this->getProperties(), $options));
        }
    }
}