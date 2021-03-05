## Input Options

The following input options could be set in template variable settings:

Setting | Description | Default
------- | ----------- | -------
Allow Blank | If set to No, MODX will not allow the user to save the Resource until a valid, non-blank value has been entered in the From Date input. | Yes
Date Format | The format must be valid according to [Date.parseDate](http://dev.sencha.com/playpen/docs/output/Date.html). | Manager date format
End Value Template Variable | Template Variable that contains the end value of the daterange. If used, the DaterangeTV contains only the start value. The end value template variable should be created as a hidden template variable type. | -

## Output Options

The following output options could be set in template variable settings if the
output type is set to `Date Range (From <> To)`. Another possibility is to
assign the settings as properties to the MODX tag[^1].

Setting | Description | Default
------- | ----------- | -------
Date Format | A between day, month and year by &#124; separated list of [strftime](https://www.php.net/manual/en/function.strftime.php) placeholders[^2]. | %e&#124; %B &#124;%Y
Separator | String between the first and second part of the daterange. | ` – `
Locale | Locale the daterange strings are formatted with. | MODX `locale` system setting

## Snippet/Output filter

If the output options for the custom tv could not be set (i.e. inside of MIGX)
or if you want to use snippet or an output filter could be used. The snippet has
the following properties:

Property | Description | Default
-------- | ----------- | -------
tvname | Name of the Daterange TV. | -
docid | Resource where the Daterange TV value is received from. | Current resource
value | Use your own value for the snippet output. The properties `tvname` and `docid` are ignored. | -
format | A between day, month and year by &#124; separated list of [strftime](https://www.php.net/manual/en/function.strftime.php) placeholders[^2]. | %e.&#124; %B &#124;%Y
separator | String between the first and second part of the daterange. | &thinsp;–&thinsp;
locale | Locale the daterange strings are formatted with. | MODX `locale` system setting
stripEqualParts | Strip equal parts from the date range output (i.e. strip the year, if start and end of the date range have the same year). | Yes

So the following snippet call could be used: 

```
[[daterange? 
&value=`2013-01-01||2013-01-02` 
&format=` %d.| %b. |%Y` 
&separator=`&thinsp;–&thinsp;` 
&locale=`de_DE.utf8`
]]
```

The snippet could work as an output filter, but then the options have to be a json
encoded array:

```
[[*daterangetv:daterange=`{"format":"%d|%m.|%Y","separator":"–","locale":"de_DE.utf8"}`]]
```

## Column Renderer

The package contains a column renderer for i.e. MIGX or Collections. In
Collections you have to insert `DaterangeTV.Renderer` in the renderer option of
the grid column. The name option has to be filled with the tv name prepended
with `tv_`.

You can't render the full value, when the `end value template variable` is
enabled. Then the colum will only contain the first value and both values could
be rendered with the `DaterangeTV.Renderer`. If you want to use only one column,
you have to fill the Collections snippet renderer option with `daterange`.

[^1]: The daterange template tariable could be formatted in template or template chunks with the following tag syntax: ```[[*tvname?format=`%e| %B |%Y`&locale=`de_DE.utf8`]]```
[^2]: If the output type is set to `Date Range (From <> To)` the output will be formatted removing equal days and months (and years - by showing only the start date).
