<?php
/**
 * Daterange TV runtime hooks - registers custom TV input & output types
 * and includes javascripts on document edit pages so that the TV
 * can be used from within other extras (i.e. MIGX, Collections)
 *
 * @package daterangetv
 * @subpackage plugin
 *
 * @event   OnTVInputRenderList
 * @event   OnTVOutputRenderList
 * @event   OnTVInputPropertiesList
 * @event   OnTVOutputRenderPropertiesList
 * @event   OnDocFormRender
 */

/** @var \modX $modx */
$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
$assetsUrl = $modx->getOption('daterangetv.assets_url', null, $modx->getOption('assets_url') . 'components/daterangetv/');

$daterangetv = $modx->getService('daterangetv', 'DaterangeTV', $corePath . 'model/daterangetv/', array(
    'core_path' => $corePath
));

$modx->lexicon->load('daterangetv:tvrenders');

switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath . 'elements/tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath . 'elements/tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath . 'elements/tv/input/options/');
        break;
    case 'OnTVOutputRenderPropertiesList':
        $modx->event->output($corePath . 'elements/tv/output/options/');
        break;
    case 'OnDocFormRender':
        $daterangetv->includeScriptAssets();
        $modx->controller->addLexiconTopic('daterangetv:tvrenders');
        break;
};