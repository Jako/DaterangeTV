<?php
/**
 * Snippet/Output Filter for DaterangeTV
 *
 * @package daterangetv
 * @subpackage snippet/output filter
 */

namespace TreehillStudio\DaterangeTV\Snippets;

use modTemplateVarResource;
use xPDO;

class Daterange extends OutputFilter
{
    /**
     * Get default snippet properties.
     *
     * @return array
     */
    public function getDefaultProperties()
    {
        return [
            'value' => '',
            'tvname' => '',
            'docid::int' => (isset($this->modx->resource)) ? $this->modx->resource->get('id') : 0,
            'format' => '%e.| %B |%Y',
            'separator' => '&thinsp;–&thinsp;',
            'locale' => '',
            'stripEqualParts' => true,
            'tag' => '',
            'options::associativeJson' => [],
            'input' => ''
        ];
    }

    /**
     * Execute the snippet and return the result.
     *
     * @return string
     */
    public function execute()
    {
        $value = $this->getProperty('value');
        if (!$value) {
            $tvname = $this->getProperty('tvname');
            $docid = $this->getProperty('docid');
            $tv = $this->modx->getObject('modTemplateVar', ['name' => $tvname]);
            if ($tv) {
                // Get the raw content of the TV
                $value = $tv->getValue($docid);
                $inputProperties = $tv->get('input_properties');
                // end value is stored in a different template variable
                if (isset($inputProperties['endTV'])) {
                    $resource = $this->modx->getObject('modTemplateVarResource', [
                        'tmplvarid' => $inputProperties['endTV'],
                        'contentid' => $docid,
                    ]);
                    $endValue = ($resource instanceof modTemplateVarResource) ? $resource->get('value') : '';
                    $value = ($endValue != '') ? $value . '||' . $endValue : $value;
                }
            } else {
                $this->modx->log(xPDO::LOG_LEVEL_DEBUG, 'Template Variable ' . $tvname . ' not found.', '', 'DaterangeTV');
            }
        }

        return $this->daterangetv->getDaterange($value, $this->getProperties());
    }
}
