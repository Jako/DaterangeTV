<?php
/**
 * Input Render for Daterange TV
 *
 * @package daterangetv
 * @subpackage input render
 */
if (!class_exists('DaterangeInputRender')) {

    class DaterangeInputRender extends modTemplateVarInputRender
    {
        public function getTemplate()
        {
            $corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
            return $corePath . 'tv/input/tpl/daterange.tpl';
        }

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
            $this->modx->lexicon->load('tv_widget');
            $this->modx->lexicon->load('daterangetv:tvrenders');
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
}
return 'DaterangeInputRender';
?>