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

            // fetch only the tv lexicon
            $this->modx->lexicon->load('tv_widget,daterangetv:tvrenders');
            $lang = $this->modx->lexicon->fetch();
            foreach ($lang as $k => $v) {
                if (strpos($k, 'daterangetv.') !== false) {
                    $k = str_replace('daterangetv.', '', $k);
                    $k = str_replace('.', '_', $k);
                }
                $this->setPlaceholder('lang_' . $k, $v);
            }
            $this->setPlaceholder('params', $params);
        }
}
return 'DaterangeInputRender';