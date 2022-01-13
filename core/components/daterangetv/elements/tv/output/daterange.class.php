<?php
/**
 * DaterangeTV Output Render
 *
 * @package daterangetv
 * @subpackage output_render
 */

class DaterangeOutputRender extends modTemplateVarOutputRender
{
    /**
     * Process Output Render
     *
     * @param string $value
     * @param array $params
     * @return string
     */
    public function process($value, array $params = [])
    {
        // Load daterangetv class
        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        /** @var DaterangeTV $daterangetv */
        $daterangetv = $this->modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
            'core_path' => $corePath
        ]);

        $properties = array_merge($params, (is_array($this->tv->_properties)) ? $this->tv->_properties : []);

        $inputProperties = $this->tv->get('input_properties');
        // end value is stored in a different template variable
        if (isset ($inputProperties['endTV'])) {
            $resource = $this->modx->getObject('modTemplateVarResource', [
                'tmplvarid' => $inputProperties['endTV'],
                'contentid' => $this->modx->resource->get('id'),
            ]);
            $endValue = ($resource instanceof modTemplateVarResource) ? $resource->get('value') : '';
            $value = ($endValue != '') ? $value . '||' . $endValue : $value;
        }

        return $daterangetv->getDaterange($value, $properties);
    }
}

return 'DaterangeOutputRender';
