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
 * @subpackage output render
 *
 * Output Render for Daterange TV
 */
if (!class_exists('DaterangeOutputRender')) {

	class DaterangeOutputRender extends modTemplateVarOutputRender {

		public function process($value, array $params = array()) {
			$params = array_merge($params, $this->tv->_properties);

			// get params
			$format = $this->modx->getOption('format', $params, ' %e| %B |%Y');
			$format = explode('|', $format);
			if (count($format) != 3) {
				$format = explode('|', '%e| %B |%Y');
			}
			$separator = $this->modx->getOption('separator', $params, ' – ');
			$locale = $this->modx->getOption('locale', $params, '');

			// get value
			$daterange = explode('||', $value);
			$daterange[0] = (isset($daterange[0]) && $daterange[0] != '') ? intval(strtotime($daterange[0])) : 0;
			$daterange[1] = (isset($daterange[1]) && $daterange[1] != '') ? intval(strtotime($daterange[1])) : 0;

			// set locale
			if ($locale != '') {
				$currentLocale = setlocale(LC_ALL, 0);
				if (!setlocale(LC_ALL, $locale)) {
					$this->modx->log(modX::LOG_LEVEL_DEBUG, 'DaterangeTV: Locale ' . $locale . 'not valid!');
				}
			}

			// calculate daterange output
			if (intval($daterange[1]) > intval($daterange[0])) {
				$end = trim(strftime($format[0] . $format[1] . $format[2], $daterange[1]));

				$start_day = date('d', $daterange[0]);
				$start_month = date('m', $daterange[0]);
				$start_year = date('Y', $daterange[0]);

				$end_day = date('d', $daterange[1]);
				$end_month = date('m', $daterange[1]);
				$end_year = date('Y', $daterange[1]);

				if ($start_year != $end_year) {
					$start = trim(strftime($format[0] . $format[1] . $format[2], $daterange[0])) . $separator;
				} elseif ($start_month != $end_month) {
					$start = trim(strftime($format[0] . $format[1], $daterange[0])) . $separator;
				} elseif ($start_day != $end_day) {
					$start = trim(strftime($format[0], $daterange[0])) . $separator;
				} else {
					$start = '';
				}
				$output = $start . $end;
			} else {
				$output = trim(strftime($format[0] . $format[1] . $format[2], $daterange[0]));
			}

			// reset locale
			if ($locale != '') {
				setlocale(LC_ALL, $currentLocale);
				if (!setlocale(LC_ALL, $currentLocale)) {
					$this->modx->log(modX::LOG_LEVEL_DEBUG, 'DaterangeTV: Old locale ' . $currentLocale . 'not valid!');
				}
			}
			return ($output);
		}

	}

}
return 'DaterangeOutputRender';
?>