<?php
/**
 * Output Render for Daterange TV
 *
 * @package daterangetv
 * @subpackage output render
 */
if (!class_exists('DaterangeOutputRender')) {

    class DaterangeOutputRender extends modTemplateVarOutputRender
    {
        public function process($value, array $params = array())
        {
            $params = array_merge($params, $this->tv->_properties);

            // get params
            $format = $this->modx->getOption('format', $params, ' %e| %B |%Y');
            $format = explode('|', $format);
            if (count($format) != 3) {
                $format = explode('|', '%e| %B |%Y');
            }
            $separator = $this->modx->getOption('separator', $params, ' – ');
            $locale = $this->modx->getOption('locale', $params, $this->modx->getOption('locale', null, ''), true);

            // get value
            $daterange = explode('||', $value);
            $daterange[0] = (isset($daterange[0]) && $daterange[0] != '') ? intval(strtotime($daterange[0])) : 0;
            $daterange[1] = (isset($daterange[1]) && $daterange[1] != '') ? intval(strtotime($daterange[1])) : 0;

            // set locale
            if ($locale != '') {
                $currentLocale = setlocale(LC_ALL, 0);
                if (!setlocale(LC_ALL, $locale)) {
                    $this->modx->log(modX::LOG_LEVEL_DEBUG, 'DaterangeTV: Locale ' . $locale . 'not valid!');
                }
            }

            // calculate daterange output
            if (intval($daterange[1]) > intval($daterange[0])) {
                $end = trim(strftime($format[0] . $format[1] . $format[2], $daterange[1]));

                $start_day = date('d', $daterange[0]);
                $start_month = date('m', $daterange[0]);
                $start_year = date('Y', $daterange[0]);

                $end_day = date('d', $daterange[1]);
                $end_month = date('m', $daterange[1]);
                $end_year = date('Y', $daterange[1]);

                if ($start_year != $end_year) {
                    $start = trim(strftime($format[0] . $format[1] . $format[2], $daterange[0])) . $separator;
                } elseif ($start_month != $end_month) {
                    $start = trim(strftime($format[0] . $format[1], $daterange[0])) . $separator;
                } elseif ($start_day != $end_day) {
                    $start = trim(strftime($format[0], $daterange[0])) . $separator;
                } else {
                    $start = '';
                }
                $output = $start . $end;
            } else {
                $output = trim(strftime($format[0] . $format[1] . $format[2], $daterange[0]));
            }

            // reset locale
            if ($locale != '') {
                setlocale(LC_ALL, $currentLocale);
                if (!setlocale(LC_ALL, $currentLocale)) {
                    $this->modx->log(modX::LOG_LEVEL_DEBUG, 'DaterangeTV: Old locale ' . $currentLocale . 'not valid!');
                }
            }
            return ($output);
        }
    }
}
return 'DaterangeOutputRender';
?>