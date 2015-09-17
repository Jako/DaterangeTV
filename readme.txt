DaterangeTV
===========

Date range custom template variable for MODX Revolution.

Features
--------

With this MODX Revolution custom template variable two depending date inputs 
could be used to insert a date range in a MODX resource. 

Installation
------------

MODX Package Management

Input Options
-------------

The following input options could be set in template variable settings.

Setting     | Description                                  | Default
----------- | -------------------------------------------- | -------------------
Allow Blank | If set to No, MODX will not allow the user   | Yes
            | to save the Resource until a valid,          |
            | non-blank value has been entered in the      |
            | From Date input.                             | 
Date Format | The format must be valid according to        | Manager date format
            | Date.parseDate.                              | 

Output Options
--------------

The following output options could be set in template variable settings if the
output type is set to `Date Range (From <> To)`. Another possibility is to 
assign the settings as properties to the MODX tag (see note 1).

Setting     | Description                               | Default
----------- | ----------------------------------------- | --------------
Date Format | A between day, month and year by |        | %e| %B |%Y
            | separated list of strftime placeholders   |
            | (see note 2).                             |
Separator   | String between the first and second part  | '&nbsp;–&nbsp;'
            | of the daterange.                         |
Locale      | Locale the daterange strings are          | MODX locale
            | formatted with.                           | system setting

Snippet/Output filter
---------------------

If the output options for the custom tv could not be set (i.e. inside of MIGX) or if you want to use
snippet or an output filter could be used. The snippet has the following properties:

Property  | Description                                 | Default
--------- | ------------------------------------------- | --------------
tvname    | Name of the Daterange TV.                   | -
docid     | Resource where the Daterange TV value is    | Current resource
          | received from.                              |
value     | Use your own value for the snippet output.  | -
          | The properties `tvname` and `docid` are     |
          | ignored.                                    |
format    | A between day, month and year by |          | %e.| %B |%Y
          | separated list of strftime placeholders     |
          | (see note 2).                               |
separator | String between the first and second part    | '&nbsp;–&nbsp;'
          | of the daterange.                           |
Locale    | Locale the daterange strings are            | MODX locale
          | formatted with.                             | system setting

So the following snippet call could be used:

[[daterange?
&value=`2013-01-01||2013-01-02`
&format=` %d.| %b. |%Y`
&separator=`&thinsp;–&thinsp;`
&locale=`de_DE.utf8`
]]

The snippet could work as an output filter, but then the options have to be a json
encoded array:

[[*daterangetv:daterange=`{"format":"%d|%m.|%Y","separator":"–","locale":"de_DE.utf8"}`]]

Column Renderer
---------------

The package contains a column renderer for i.e. MIGX or Collections. In Collections you have to
insert `DaterangeTV.Renderer` in the renderer option of the grid column.

Notes
--------------------------------------------------------------------------------

1. The daterange template tariable could be formatted in template or template 
   chunks with the following tag syntax:
   [[*tvname?format=`%e| %B |%Y`&locale=`de_DE.utf8`]]
2. If the output type is set to `Date Range (From <> To)` the output will be 
   formatted removing equal days and months (and years - by showing only the 
   start date).

Documentation and bug report on GitHub: https://github.com/Jako/DaterangeTV