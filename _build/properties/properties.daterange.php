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
 * @subpackage build
 *
 * Properties for the daterange snippet.
 */
$properties = array(
	array(
		'name' => 'value',
		'desc' => 'prop_daterange.value',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'daterange:properties',
	),
	array(
		'name' => 'format',
		'desc' => 'prop_daterange.format',
		'type' => 'textfield',
		'options' => '%e| %B |%Y',
		'value' => ';',
		'lexicon' => 'daterange:properties',
	),
	array(
		'name' => 'separator',
		'desc' => 'prop_daterange.separator',
		'type' => 'textfield',
		'options' => '',
		'value' => ' – ',
		'lexicon' => 'daterange:properties',
	),
	array(
		'name' => 'locale',
		'desc' => 'prop_daterange.locale',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'daterange:properties',
	)
);

return $properties;