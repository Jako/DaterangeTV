<?php
/**
 * Daterange TV
 *
 * Copyright 2013 by Thomas Jakobi <thomas.jakobi@partout.info>
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
 * @subpackage input render
 *
 * Input Render for Daterange TV
 */
if (!class_exists('DaterangeInputRender')) {

	class DaterangeInputRender extends modTemplateVarInputRender {

		public function getTemplate() {
			$corePath = $this->modx->getOption('daterangetv.core_path', null, $this->modx->getOption('core_path') . 'components/daterangetv/');
			return $corePath . 'tv/input/tpl/daterange.tpl';
		}

		public function process($value, array $params = array()) {
			$dateFormat = $this->modx->getOption('date_format', $params, $this->modx->getOption('manager_date_format'));

			// set daterange value
			$daterange = array();
			if (strpos($value, '||')) {
				$daterange = explode('||', $value);
				$daterange[0] = ($daterange[0] != '') ? date($dateFormat, strtotime($daterange[0])) : '';
				$daterange[1] = ($daterange[1] != '') ? date($dateFormat, strtotime($daterange[1])) : '';
			}
			$this->setPlaceholder('daterange', $daterange);

			// fetch only the tv lexicon
			$this->modx->lexicon->load('tv_widget');
			$this->modx->lexicon->load('daterangetv:tvrenders');
			$lang = $this->modx->lexicon->fetch();
			foreach ($lang as $k => $v) {
				if (strpos($k, 'daterangetv.') !== false) {
					$k = str_replace('daterangetv.', '', $k);
					$k = str_replace('.', '_', $k);
				}
				$this->setPlaceholder('lang_' . $k, $v);
			}
			$this->setPlaceholder('params', $params);
		}

	}

}
return 'DaterangeInputRender';
?>