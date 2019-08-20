<?php
/**
 * DaterangeTV Input Properties
 *
 * @package daterangetv
 * @subpackage input properties
 *
 * @var modX $modx
 */

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');

return $modx->smarty->fetch($corePath . 'elements/tv/input/tpl/daterange.options.tpl');
