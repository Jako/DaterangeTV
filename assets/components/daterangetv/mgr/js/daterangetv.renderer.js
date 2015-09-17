/**
 * Output Renderer for Daterange TV
 *
 * @package daterangetv
 * @subpackage output renderer
 * @return {string}
 */

DaterangeTV.Renderer = function (value) {
    if (!value.length) {
        return '';
    }

    var data = value.split('||');
    var start = (data.length >= 1) ? new Date(data[0]) : false;
    var end = (data.length >= 2) ? new Date(data[1]) : false;
    var format = MODx.config['daterangetv.manager_format'].split('|');
    var separator = MODx.config['daterangetv.separator'];
    var result = '';

    if (start && start.getTime() === start.getTime()) {
        if (end && end.getTime() === end.getTime()) {
            if (start.getFullYear() != end.getFullYear()) {
                result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
            } else {
                if (start.getMonth() != end.getMonth()) {
                    result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
                } else {
                    if (start.getDay() != end.getDay()) {
                        result = Ext.util.Format.date(start, format[0]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
                    } else {
                        result = Ext.util.Format.date(start, format[0] + format[1] + format[2]);
                    }
                }
            }
        } else {
            result = Ext.util.Format.date(start, format[0] + format[1] + format[2]);
        }
    }
    return result;
};
