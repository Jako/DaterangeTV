<?php

/**
 * Output Render for Daterange TV
 *
 * @package daterangetv
 * @subpackage output render
 */
class DaterangeOutputRender extends modTemplateVarOutputRender
{
    /**
     * @param string $value
     * @param array $params
     * @return void|mixed
     */
    public function process($value, array $params = array())
    {
        // Load daterangetv class
        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        $daterangetv = $this->modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', array(
            'core_path' => $corePath
        ));

        $properties = array_merge($params, $this->tv->_properties);
        return $daterangetv->getDaterange($value, $properties);
    }
}

return 'DaterangeOutputRender';
