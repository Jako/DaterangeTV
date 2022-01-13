<?php
/**
 * @package daterangetv
 * @subpackage plugin
 */

namespace TreehillStudio\DaterangeTV\Plugins\Events;

use TreehillStudio\DaterangeTV\Plugins\Plugin;

class OnManagerPageBeforeRender extends Plugin
{
    public function process()
    {
        $this->modx->controller->addLexiconTopic('daterangetv:default');
        $this->daterangetv->includeScriptAssets();
    }
}
