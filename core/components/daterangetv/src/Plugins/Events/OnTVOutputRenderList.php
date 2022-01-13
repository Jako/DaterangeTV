<?php
/**
 * @package daterangetv
 * @subpackage plugin
 */

namespace TreehillStudio\DaterangeTV\Plugins\Events;

use TreehillStudio\DaterangeTV\Plugins\Plugin;

class OnTVOutputRenderList extends Plugin
{
    public function process()
    {
        $this->modx->event->output($this->daterangetv->getOption('corePath') . 'elements/tv/output/');
    }
}
