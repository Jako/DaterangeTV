<?php
/**
 * Render Lexicon Entries for DaterangeTV
 *
 * @package daterangetv
 * @subpackage language
 */

$_lang['daterangetv'] = 'DaterangeTV';

$_lang['daterange'] = 'Date Range (From <> To)';
$_lang['daterangetv.from'] = 'From Date';
$_lang['daterangetv.to'] = 'To Date';

$_lang['daterangetv.dateFormat'] = 'Date Format';
$_lang['daterangetv.dateFormatDesc'] = 'The format must be valid according to <a href="https://docs.sencha.com/extjs/3.4.0/#!/api/Date" target="_blank">Ext JS Date</a> (defaults to manager date format).';
$_lang['daterangetv.endTV'] = 'End Value Template Variable';
$_lang['daterangetv.endTVDesc'] = 'Template Variable that contains the end value of the daterange. If used, the DaterangeTV contains only the start value. The end value template variable should be created as a hidden template variable type.';

$_lang['daterangetv.dateOutputFormat'] = 'Date Format';
$_lang['daterangetv.dateOutputFormatDesc'] = 'A between day, month and year by <em>|</em> separated list of <a href="https://www.php.net/manual/en/function.strftime.php" target="_blank">strftime</a> placeholders.';
$_lang['daterangetv.separatorOutput'] = 'Separator';
$_lang['daterangetv.separatorOutputDesc'] = 'String between the first and second part of the daterange.';
$_lang['daterangetv.localeOutput'] = 'Locale';
$_lang['daterangetv.localeOutputDesc'] = '<a href="https://www.php.net/manual/de/function.setlocale.php">Locale</a> the daterange is formatted with. Defaults to MODX locale system setting.';
