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

// Load daterangetv class
$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
    'core_path' => $corePath
]);

// Get script properties
$value = $modx->getOption('value', $scriptProperties, '', true);
$tvname = $modx->getOption('tvname', $scriptProperties, '', true);
$docid = $modx->getOption('docid', $scriptProperties, (isset($modx->resource)) ? $modx->resource->get('id') : 0, true);

// Used as output filter
if (!empty($tag)) {
    $scriptProperties = json_decode($options, true);
    $value = $input;
}

if (!$value) {
    $tv = $modx->getObject('modTemplateVar', ['name' => $tvname]);
    if ($tv) {
        // Get the raw content of the TV
        $value = $tv->getValue($docid);
        $inputProperties = $tv->get('input_properties');
        // end value is stored in a different template variable
        if (isset ($inputProperties['endTV'])) {
            $resource = $modx->getObject('modTemplateVarResource', [
                'tmplvarid' => $inputProperties['endTV'],
                'contentid' => $docid,
            ], true);
            $endValue = ($resource instanceof modTemplateVarResource) ? $resource->get('value') : '';
            $value = ($endValue != '') ? $value . '||' . $endValue : $value;
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_DEBUG, 'Template Variable ' . $tvname . ' not found.', '', 'DaterangeTV');
    }
}

return $daterangetv->getDaterange($value, $scriptProperties);
