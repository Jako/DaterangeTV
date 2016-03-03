<?php

/**
 * Main Class for Daterange TV
 *
 * Copyright 2013-2016 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package daterangetv
 * @subpackage classfile
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
     * The version
     * @var string $version
     */
    public $version = '1.2.3';

    /**
     * The class options
     * @var array $options
     */
    public $options = array();

    /**
     * DaterangeTV constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    function __construct(modX &$modx, array $options = array())
    {
        $this->modx = &$modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path') . 'components/daterangetv/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path') . 'components/daterangetv/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url') . 'components/daterangetv/');

        // Load some default paths for easier management
        $this->options = array_merge(array(
            'namespace' => $this->namespace,
            'version' => $this->version,
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
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
            'connectorUrl' => $assetsUrl . 'connector.php',
        ), $options);

        // set default options
        $this->options = array_merge($this->options, array());

        $this->modx->lexicon->load('daterangetv:default');
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
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    /**
     * Gets an option through $this->getOption and cast the value to a true boolean automatically,
     * including strings "false", "true", "yes" and "no".
     *
     * @param string $name
     * @param array $options
     * @param bool $default
     * @return bool
     */
    public function getBooleanOption($name, array $options = null, $default = null)
    {
        $option = $this->getOption($name, $options, $default);
        return $this->castValueToBool($option);
    }

    /**
     * Turns a value into a boolean. This checks for "false", "true", "yes" and "no" strings,
     * as well as anything PHP can automatically cast to a boolean value.
     *
     * @param $value
     * @return bool
     */
    public function castValueToBool($value)
    {
        if (in_array(strtolower($value), array('false', 'no'))) {
            return false;
        }
        return (bool)$value;
    }

    /**
     * Render supporting javascript to try and help it work with MIGX etc
     */
    public function includeScriptAssets()
    {
        $this->modx->regClientStartupScript($this->options['assetsUrl'] . 'mgr/js/daterangetv.js?v=v' . $this->version);
        $this->modx->regClientStartupScript($this->options['assetsUrl'] . 'mgr/js/daterangetv.renderer.js?v=v' . $this->version);
    }

    /**
     * Return a formatted daterange
     * @param $value
     * @param array $properties
     * @return string
     */
    public function getDaterange($value, $properties = array())
    {
        $format = $this->getOption('format', $properties);
        $debug = $this->getBooleanOption('debug', $properties, false);

        if (preg_match('/(d|e|j)/', $format, $dayformat, PREG_OFFSET_CAPTURE) === 1) {
            $dayPos = $dayformat[0][1];
        } else {
            $dayPos = false;
            if ($debug) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'A valid strftime day format (%d, %e or %j) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }
        if (preg_match('/(b|B|h|m)/', $format, $monthformat, PREG_OFFSET_CAPTURE) === 1) {
            $monthPos = $monthformat[0][1];
        } else {
            $monthPos = false;
            if ($debug) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'A valid strftime month format (%b, %B, %h or %m) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }
        if (preg_match('/(Y|y|G|g|C)/', $format, $yearformat, PREG_OFFSET_CAPTURE) === 1) {
            $yearPos = $yearformat[0][1];
        } else {
            $yearPos = false;
            if ($debug) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'A valid strftime year format (%Y, %y, %G, %g or %C) has not been specified or an incorrect syntax was used in the format string.', '', 'DaterangeTV');
            }
        }

        $daysBeforeMonths = ($dayPos !== false && $monthPos !== false && ($monthPos > $dayPos)) ? true : false;
        $yearsFirst = ($dayPos === false || $monthPos === false || $yearPos === false || $yearPos > $monthPos || $yearPos > $dayPos) ? false : true;

        $separator = $this->getOption('separator', $properties);
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
            $currentLocale = setlocale(LC_ALL, 0);
            if (!setlocale(LC_ALL, $locale) && $debug) {
                $this->modx->log(modX::LOG_LEVEL_DEBUG, 'Locale ' . $locale . 'not valid!', '', 'DaterangeTV');
            }
        }

        // calculate daterange output
        if (intval($end) > intval($start)) {
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
                $this->modx->log(modX::LOG_LEVEL_DEBUG, 'Old locale ' . $currentLocale . 'not valid!', '', 'DaterangeTV');
            }
        }
        return ($output);
    }
}
