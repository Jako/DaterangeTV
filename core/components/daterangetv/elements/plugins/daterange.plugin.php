<?php
/**
 * Plugin Render for Daterange TV
 *
 * Copyright 2013-2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * Daterange TV is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Daterange TV is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * DaterangeTV; if not, write to the Free Software Foundation, Inc., 59
 * Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package daterangetv
 * @subpackage plugin
 */
$modx->lexicon->load('daterangetv:tvrenders');

$corePath = $modx->getOption('daterangetv.core_path', null, $modx->getOption('core_path') . 'components/daterangetv/');
switch ($modx->event->name) {
    case 'OnTVInputRenderList': {
        $modx->event->output($corePath . 'tv/input/');
        break;
    }
    case 'OnTVOutputRenderList': {
        $modx->event->output($corePath . 'tv/output/');
        break;
    }
    case 'OnTVInputPropertiesList': {
        $modx->event->output($corePath . 'tv/inputoptions/');
        break;
    }
    case 'OnTVOutputRenderPropertiesList': {
        $modx->event->output($corePath . 'tv/properties/');
        break;
    }
}
?>