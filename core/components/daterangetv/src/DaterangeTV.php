<?php
/**
 * DaterangeTV
 *
 * Copyright 2013-2023 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @package daterangetv
 * @subpackage classfile
 */

namespace TreehillStudio\DaterangeTV;

use modX;
use xPDO;

/**
 * Class DaterangeTV
 */
class DaterangeTV
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'daterangetv';

    /**
     * The package name
     * @var string $packageName
     */
    public $packageName = 'DaterangeTV';

    /**
     * The version
     * @var string $version
     */
    public $version = '1.4.4';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * DaterangeTV constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = [])
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/' . $this->namespace . '/');
        $modxversion = $this->modx->getVersionData();

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $assetsUrl . 'connector.php'
        ], $options);

        // Add default options
        $this->options = array_merge($this->options, [
            'debug' => (bool)$this->modx->getOption($this->namespace . '.debug', null, '0') == 1,
            'modxversion' => $modxversion['version']
        ]);

        $lexicon = $this->modx->getService('lexicon', 'modLexicon');
        $lexicon->load($this->namespace . ':default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }

    /**
     * Get Boolean Option
     *
     * @param string $key
     * @param array $options
     * @param mixed $default
     * @return bool
     */
    public function getBooleanOption($key, $options = [], $default = null)
    {
        $option = $this->getOption($key, $options, $default);
        return ($option === 'true' || $option === true || $option === '1' || $option === 1);
    }

    /**
     * Register javascripts in the controller
     */
    public function includeScriptAssets()
    {
        $assetsUrl = $this->getOption('assetsUrl');
        $jsUrl = $this->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->getOption('debug') && $assetsUrl != MODX_ASSETS_URL . 'components/daterangetv/') {
            $this->modx->controller->addJavascript($jsSourceUrl . 'daterangetv.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'daterangetv.templatevar.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'daterangetv.renderer.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssSourceUrl . 'daterangetv.css?v=v' . $this->version);
        } else {
            $this->modx->controller->addJavascript($jsUrl . 'daterangetv.min.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssUrl . 'daterangetv.min.css?v=v' . $this->version);
        }
        $this->modx->controller->addHtml('<script type="text/javascript">' .
            'DaterangeTV.config = ' . json_encode($this->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';' .
            '</script>');
    }

    /**
     * Return a formatted daterange
     * @param $value
     * @param array $properties
     * @return string
     */
    public function getDaterange($value, $properties = [])
    {
        $format = $this->getOption('format', $properties);
        $debug = $this->getBooleanOption('debug', $properties, false);

        if (preg_match('/([dej])/', $format, $dayformat, PREG_OFFSET_CAPTURE) === 1) {
            $dayPos = $dayformat[0][1];
        } else {
            $dayPos = false;
            if ($debug) {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'A valid strftime day format (%d, %e or %j) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }
        if (preg_match('/([bBhm])/', $format, $monthformat, PREG_OFFSET_CAPTURE) === 1) {
            $monthPos = $monthformat[0][1];
        } else {
            $monthPos = false;
            if ($debug) {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'A valid strftime month format (%b, %B, %h or %m) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }
        if (preg_match('/([YyGgC])/', $format, $yearformat, PREG_OFFSET_CAPTURE) === 1) {
            $yearPos = $yearformat[0][1];
        } else {
            $yearPos = false;
            if ($debug) {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'A valid strftime year format (%Y, %y, %G, %g or %C) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }

        $daysBeforeMonths = $dayPos !== false && $monthPos !== false && ($monthPos > $dayPos);
        $yearsFirst = !(($dayPos === false || $monthPos === false || $yearPos === false || $yearPos > $monthPos || $yearPos > $dayPos));

        $separator = $this->getOption('separator', $properties);
        $separator = ($separator == '') ? $this->getOption('separator') : $separator;
        $locale = $this->getOption('locale', $properties, false);
        $stripEqualParts = $this->getBooleanOption('stripEqualParts', $properties, true);

        $format = explode('|', $format);
        if (count($format) != 3) {
            $format = explode('|', $this->getOption('format'));
        }

        // get value
        $daterange = explode('||', $value);
        $start = (isset($daterange[0]) && $daterange[0] != '') ? intval(strtotime($daterange[0])) : 0;
        $end = (isset($daterange[1]) && $daterange[1] != '') ? intval(strtotime($daterange[1])) : 0;

        // set locale
        if ($locale) {
            $currentLocale = setlocale(LC_ALL, '0');
            if (!setlocale(LC_ALL, $locale) && $debug) {
                $this->modx->log(xPDO::LOG_LEVEL_DEBUG, 'Locale ' . $locale . 'not valid!', '', 'DaterangeTV');
            }
        }

        // calculate daterange output
        if ($end > $start) {
            $start_day = date('d', $start);
            $start_month = date('m', $start);
            $start_year = date('Y', $start);

            $end_day = date('d', $end);
            $end_month = date('m', $end);
            $end_year = date('Y', $end);

            if ($start_year != $end_year || !$stripEqualParts) {
                $output = trim(strftime($format[0] . $format[1] . $format[2], $start)) . $separator . trim(strftime($format[0] . $format[1] . $format[2], $end));
            } elseif ($start_month != $end_month) {
                if ($yearsFirst) {
                    $output = trim(strftime($format[0] . $format[1] . $format[2], $start)) . $separator . trim(strftime($format[1] . $format[2], $end));
                } else {
                    $output = trim(strftime($format[0] . $format[1], $start)) . $separator . trim(strftime($format[0] . $format[1] . $format[2], $end));
                }
            } elseif ($start_day != $end_day) {
                if ($yearsFirst) {
                    if ($daysBeforeMonths) {
                        $output = trim(strftime($format[0] . $format[1], $start)) . $separator . trim(strftime($format[1] . $format[2], $end));
                    } else {
                        $output = trim(strftime($format[0] . $format[1] . $format[2], $start)) . $separator . trim(strftime($format[2], $end));
                    }
                } else {
                    if ($daysBeforeMonths) {
                        $output = trim(strftime($format[0], $start)) . $separator . trim(strftime($format[0] . $format[1] . $format[2], $end));
                    } else {
                        $output = trim(strftime($format[0] . $format[1], $start)) . $separator . trim(strftime($format[1] . $format[2], $end));
                    }
                }
            } else {
                $output = trim(strftime($format[0] . $format[1] . $format[2], $start));
            }
        } else {
            $output = trim(strftime($format[0] . $format[1] . $format[2], $start));
        }

        // reset locale
        if (isset($currentLocale)) {
            if (!setlocale(LC_ALL, $currentLocale) && $debug) {
                $this->modx->log(xPDO::LOG_LEVEL_DEBUG, 'Old locale ' . $currentLocale . 'not valid!', '', 'DaterangeTV');
            }
        }
        return ($output);
    }
}
