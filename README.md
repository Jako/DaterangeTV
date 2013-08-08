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
The following output options could be set in template variable settings if the output type is set to `Date Range (From <> To)`. Another possibility is to assign the settings as properties to the MODX tag (see note 1).

Setting   | Title       | Description                                                                                   | Default
--------- | ----------- | --------------------------------------------------------------------------------------------- | --------------
format    | Date Format | A between day, month and year by &#124; separated list of strftime placeholders (see note 2). | %e&#124; %B &#124;%Y
separator | Separator   | String between the first and second part of the daterange.                                    | ` – `
locale    | Locale      | Locale the daterange strings are formatted with.                                              | 

Snippet/Output filter
--------------------------------------------------------------------------------
If output options for the custom tv could not be set (i.e. inside of MIGX) a snippet or an output filter could be used. The snippet has the same properties as the settings for the custom template variable output optiona and a value property. So the following snippet call could be used:

```
[[daterange? &value=`2013-01-01||2013-01-02` &format=`%d|%m.|%Y` &separator=`–` &locale=`de_DE.utf8`]]
```

The snippet could work as an output filter, but the options have to be a json encoded array:

```
[[*daterangetv:daterange=`{"format":"%d|%m.|%Y","separator":"–","locale":"de_DE.utf8"}`]]
```

Notes
--------------------------------------------------------------------------------

1. The daterange template tariable could be formatted in template or template chunks with the following tag syntax:
```[[*tvname?format=`%e| %B |%Y`&locale=`de_DE.utf8`]]```
2. If the output type is set to `Date Range (From <> To)` the output will be formatted removing equal days and months (and years - by showing only the start date).
