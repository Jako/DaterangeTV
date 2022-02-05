<?php
/**
 * Snippet/Output Filter for DaterangeTV
 *
 * @package daterangetv
 * @subpackage snippet/output filter
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var string $options
 * @var string $input
 */

use TreehillStudio\DaterangeTV\Snippets\Daterange;

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
/** @var DaterangeTV $daterangetv */
$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
    'core_path' => $corePath
]);

$snippet = new Daterange($modx, $scriptProperties);
if ($snippet instanceof TreehillStudio\DaterangeTV\Snippets\Daterange) {
    return $snippet->execute();
}
return 'TreehillStudio\DaterangeTV\Snippets\Daterange class not found';