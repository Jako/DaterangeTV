<?php
/**
 * Daterange TV Output Render
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
    public function process($value, array $params = array())
    {
        // Load daterangetv class
        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        /** @var DaterangeTV $daterangetv */
        $daterangetv = $this->modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', array(
            'core_path' => $corePath
        ));

        $properties = array_merge($params, (is_array($this->tv->_properties)) ? $this->tv->_properties : array());

        $inputProperties = $this->tv->get('input_properties');
        // end value is stored in a different template variable
        if (isset ($inputProperties['endTV'])) {
            $resource = $this->modx->getObject('modTemplateVarResource', array(
                'tmplvarid' => $inputProperties['endTV'],
                'contentid' => $this->modx->resource->get('id'),
            ), true);
            $endValue = ($resource && $resource instanceof modTemplateVarResource) ? $resource->get('value') : '';
            $value = ($endValue != '') ? $value . '||' . $endValue : $value;
        }

        return $daterangetv->getDaterange($value, $properties);
    }
}

return 'DaterangeOutputRender';
