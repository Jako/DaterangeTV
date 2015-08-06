<?php
/**
 * Input Render for Daterange TV
 *
 * @package daterangetv
 * @subpackage input render
 */
    class DaterangeInputRender extends modTemplateVarInputRender
    {
        /**
         * Return the template path to load
         * @return string
         */
        public function getTemplate()
        {
            $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
            return $corePath . 'elements/tv/input/tpl/daterange.render.tpl';
        }

        /**
         * @param string $value
         * @param array $params
         * @return void|mixed
         */
        public function process($value, array $params = array())
        {
            $dateFormat = $this->modx->getOption('date_format', $params, $this->modx->getOption('manager_date_format'));

            // set daterange value
            $daterange = array();
            if (strpos($value, '||')) {
                $daterange = explode('||', $value);
                $daterange[0] = ($daterange[0] != '') ? date($dateFormat, strtotime($daterange[0])) : '';
                $daterange[1] = ($daterange[1] != '') ? date($dateFormat, strtotime($daterange[1])) : '';
            }
            $this->setPlaceholder('daterange', $daterange);

            // add lexicon topic
            $this->modx->controller->addLexiconTopic('daterangetv:tvrenders');

            // set params
            $this->setPlaceholder('params', $params);
        }
}
return 'DaterangeInputRender';