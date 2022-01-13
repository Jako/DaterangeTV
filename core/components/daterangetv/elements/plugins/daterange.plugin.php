<?php
/**
 * DaterangeTV Runtime Hooks
 *
 * Registers custom TV input & output types and includes javascripts on document
 * edit pages so that the TV can be used from within other extras (i.e. MIGX,
 * Collections)
 *
 * @package daterangetv
 * @subpackage plugin
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVOutputRenderList
 * @event OnTVInputPropertiesList
 * @event OnTVOutputRenderPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = 'TreehillStudio\DaterangeTV\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
/** @var DaterangeTV $daterangetv */
$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', [
    'core_path' => $corePath
]);

if ($daterangetv) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'DaterangeTV Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'DaterangeTV Plugin');
    }
}

return;
