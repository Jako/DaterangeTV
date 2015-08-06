<?php
/**
 * Snippet/Output Filter for Daterange TV
 *
 * @package daterangetv
 * @subpackage snippet/output filter
 */

/** @var \modX $modx */
/** @var array $scriptProperties */
/** @var string $options */

// Load daterangetv class
$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', array(
    'core_path' => $corePath
));

// Get script properties
$value = $modx->getOption('value', $scriptProperties, '', true);
$tvname = $modx->getOption('tvname', $scriptProperties, '', true);
$docid = $modx->getOption('docid', $scriptProperties, ($modx->resource) ? $modx->resource->get('id') : 0, true);

if (!empty($tag)) {
    // Used as output filter
    $scriptProperties = $modx->fromJson($options);
    $value = $input;
}

if (!$value) {
    $tv = $modx->getObject('modTemplateVar', array('name' => $tvname));
    if ($tv) {
        // Get the raw content of the TV
        $value = $tv->getValue($docid);
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, "[DaterangeTV+] Template Variable '{$tvname}' not found.");
    }
}

return $daterangetv->getDaterange($value, $scriptProperties);
