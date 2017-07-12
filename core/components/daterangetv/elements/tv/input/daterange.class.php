<?php

/**
 * DaterangeTV Input Render
 *
 * @package daterangetv
 * @subpackage input_render
 */
class DaterangeInputRender extends modTemplateVarInputRender
{
    /**
     * Return the template path to load
     *
     * @return string
     */
    public function getTemplate()
    {
        $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
        return $corePath . 'elements/tv/input/tpl/daterange.render.tpl';
    }

    /**
     * Get lexicon topics
     *
     * @return array
     */
    public function getLexiconTopics()
    {
        return array('daterangetv:default');
    }

    /**
     * Process Input Render
     *
     * @param string $value
     * @param array $params
     * @return void
     */
    public function process($value, array $params = array())
    {
        $dateFormat = $this->modx->getOption('daterangetv.date_format', $params, $this->modx->getOption('manager_date_format'));

        // set daterange value
        $daterange = array();
        if ($params['endTV']) {
            // end value is stored in a different template variable
            $resource = $this->modx->getObject('modTemplateVarResource', array(
                'tmplvarid' => $params['endTV'],
                'contentid' => $this->modx->resource->get('id'),
            ), true);
            $endValue = ($resource && $resource instanceof modTemplateVarResource) ? $resource->get('value') : '';
            if (!$endValue && (strpos($value, '||'))) {
                // maintain backwards compatibility
                $daterange = explode('||', $value);
                $daterange[0] = ($daterange[0] != '') ? date($dateFormat, strtotime($daterange[0])) : '';
                $daterange[1] = ($daterange[1] != '') ? date($dateFormat, strtotime($daterange[1])) : '';
            } else {
                $daterange[0] = ($value != '') ? date($dateFormat, strtotime($value)) : '';
                $daterange[1] = ($endValue != '') ? date($dateFormat, strtotime($endValue)) : '';
            }
        } else {
            // end value is stored in the same template variable
            if (strpos($value, '||')) {
                $daterange = explode('||', $value);
                $daterange[0] = ($daterange[0] != '') ? date($dateFormat, strtotime($daterange[0])) : '';
                $daterange[1] = ($daterange[1] != '') ? date($dateFormat, strtotime($daterange[1])) : '';
            } else {
                $daterange[0] = ($value != '') ? date($dateFormat, strtotime($value)) : '';
            }
        }
        $this->setPlaceholder('daterange', $daterange);

        // add lexicon topic
        $this->modx->controller->addLexiconTopic('daterangetv:tvrenders');

        // set params
        $params['allowBlank'] = ($params['allowBlank'] === 'false' || $params['allowBlank'] === 0 || $params['allowBlank'] === false) ? false : true;
        $this->setPlaceholder('params', $params);
    }
}

return 'DaterangeInputRender';
