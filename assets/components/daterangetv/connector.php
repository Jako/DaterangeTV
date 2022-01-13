<?php
/**
 * DaterangeTV connector
 *
 * @package daterangetv
 * @subpackage connector
 *
 * @var modX $modx
 */

require_once dirname(__FILE__, 4) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
    'core_path' => $corePath
]);

// Handle request
$modx->request->handleRequest([
    'processors_path' => $daterangetv->getOption('processorsPath'),
    'location' => ''
]);
