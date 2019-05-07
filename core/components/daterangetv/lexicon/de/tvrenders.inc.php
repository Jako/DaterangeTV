<?php
/**
 * Render Lexicon Entries for DaterangeTV
 *
 * @package daterangetv
 * @subpackage language
 */
$_lang['daterangetv'] = 'DaterangeTV';

$_lang['daterange'] = 'Datumsbereich (von – bis)';
$_lang['daterangetv.from'] = 'Von Datum';
$_lang['daterangetv.to'] = 'Bis Datum';

$_lang['daterangetv.dateFormat'] = 'Datumsformat';
$_lang['daterangetv.dateFormatDesc'] = 'Das Format muss nach <a href="http://docs.sencha.com/ext-js/3-4/#!/api/Date-static-method-parseDate" target="_blank">Date.parseDate</a> gültig sein (Standard: Manager-Datumsformat).';
$_lang['daterangetv.endTV'] = 'Endwert Template Variable';
$_lang['daterangetv.endTVDesc'] = 'Template Variable die das Ende des Zeitraums enthält. Die DaterangeTV enthält bei gesetztem Wert nur noch den Startwert. Die Endwert Template Variable sollte als versteckte Template Variable angelegt werdem.';

$_lang['daterangetv.dateOutputFormat'] = 'Datumsformat';
$_lang['daterangetv.dateOutputFormatDesc'] = 'Nach Tag, Monat und Jahr mit <em>|</em> separierte Liste von <a href="http://php.net/manual/de/function.strftime.php" target="_blank">strftime</a> Platzhaltern.';
$_lang['daterangetv.separatorOutput'] = 'Trennzeichen';
$_lang['daterangetv.separatorOutputDesc'] = 'Zeichenkette, die zwischen dem ersten und dem zweiten Teil des Zeitraums ausgegeben wird.';
$_lang['daterangetv.localeOutput'] = 'Locale';
$_lang['daterangetv.localeOutputDesc'] = '<a href="http://php.net/manual/de/function.setlocale.php">Locale</a> mit der der Zeitraum ausgegeben wird (Standard: MODX Systemeinstellung "locale").';
