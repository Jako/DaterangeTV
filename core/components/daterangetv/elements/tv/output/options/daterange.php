<?php
/**
 * Output Properties for Daterange TV
 *
 * @package daterangetv
 * @subpackage output properties
 *
 * @var modX $modx
 */

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');

return $modx->smarty->fetch($corePath . 'elements/tv/output/tpl/daterange.options.tpl');