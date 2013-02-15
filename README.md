DaterangeTV
================================================================================

Date range custom template variable for MODX Revolution.

Features
--------------------------------------------------------------------------------
With this MODX Revolution custom template variable two depending date inputs could be used to insert a date range in a MODX resource. 

Installation
--------------------------------------------------------------------------------
MODX Package Management

Input Options
--------------------------------------------------------------------------------
The following input options could be set in template variable settings.

Setting     | Description                                                                                                                             | Default
----------- | --------------------------------------------------------------------------------------------------------------------------------------- | -------------------
Allow Blank | If set to No, MODX will not allow the user to save the Resource until a valid, non-blank value has been entered in the From Date input. | Yes
Date Format | The format must be valid according to Date.parseDate.                                                                                   | Manager date format

Output Options
--------------------------------------------------------------------------------
The following output options could be set in template variable settings if the output type is set to `Date Range` or. Another possibility is to assigned to the MODX tag (see note 1).

Setting   | Title       | Description                                                                                   | Default
--------- | ----------- | --------------------------------------------------------------------------------------------- | --------------
format    | Date Format | A between day, month and year by &#124; separated list of strftime placeholders (see note 2). | %e&#124; %B &#124;%Y
separator | Separator   | String between the first and second part of the daterange.                                    | ` – `
locale    | Locale      | Locale the daterange is formatted with.                                                       | 

Notes
--------------------------------------------------------------------------------

1. The daterange template tariable could be formatted in template or template chunks with the following tag syntax:
```[[*tvname?format=`%e| %B |%Y`&locale=`de_DE.utf8`]]```
2. If the output type is set to `Date Range` the output will be formatted removing equal days and months (and years - by showing only the start date).
