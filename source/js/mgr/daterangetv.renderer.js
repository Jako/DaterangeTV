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

    var data = value.split('||'),
        start = (data.length >= 1) ? new Date(data[0]) : false,
        end = (data.length >= 2) ? new Date(data[1]) : false,
        format = MODx.config['daterangetv.manager_format'].split('|'),
        separator = MODx.config['daterangetv.separator'],
        dayPos = MODx.config['daterangetv.manager_format'].search(/[djz]/),
        monthPos = MODx.config['daterangetv.manager_format'].search(/[FmMn]/),
        yearPos = MODx.config['daterangetv.manager_format'].search(/[oYy]/),
        daysBeforeMonths = monthPos > dayPos,
        yearsFirst = dayPos === -1 || monthPos === -1 || yearPos === -1 || yearPos < monthPos || yearPos < dayPos,
        result = '';
    
    if (start && start.getTime() === start.getTime()) {
        if (end && end.getTime() === end.getTime()) {
            if (start.getFullYear() !== end.getFullYear()) {
                result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
            } else {
                if (start.getMonth() !== end.getMonth()) {
                    if (yearsFirst) {
                        result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[1] + format[2]);
                    } else {
                        result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
                    }
                } else {
                    if (start.getDate() !== end.getDate()) {
                        if (yearsFirst) {
                            if (daysBeforeMonths) {
                                result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[1] + format[2]);
                            } else {
                                result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[2]);
                            }
                        } else {
                            if (daysBeforeMonths) {
                                result = Ext.util.Format.date(start, format[0]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
                            } else {
                                result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[1] + format[2]);
                            }
                        }
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
