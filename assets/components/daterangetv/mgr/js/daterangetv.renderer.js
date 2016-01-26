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
        dayPos = MODx.config['daterangetv.manager_format'].search(/d|D|j|l|N|S|w|z/),
        monthPos = MODx.config['daterangetv.manager_format'].search(/F|m|M|n|t/),
        daysBeforeMonths = monthPos > dayPos ? true : false,
        yearsFirst = monthPos === 0 || dayPos === 0 ? false : true,
        result = '';
    
    if(dayPos === -1){ 
        console.log('A valid DAY format has not been specified or an incorrect syntax was used in MODx\'s daterangetv.manager_format system setting. See php date function documentation for correct formats.'); 
    }
    if(monthPos === -1){ 
        console.log('A valid MONTH format has not been specified or an incorrect syntax was used in MODx\'s daterangetv.manager_format system setting. See php date function documentation for correct formats.'); 
    }
    
    if(start){ start = new Date(start.getUTCFullYear(),start.getUTCMonth(),start.getUTCDate()); }
    if(end){ end = new Date(end.getUTCFullYear(),end.getUTCMonth(),end.getUTCDate()); }
    
    if (start && start.getTime() === start.getTime()) {
        if (end && end.getTime() === end.getTime()) {
            if (start.getFullYear() != end.getFullYear()) {
                result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
            } else {
                if (start.getMonth() != end.getMonth()) {
                    if (yearsFirst){
                        result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[1] + format[2]);
                    } else {
                        result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[0] + format[1] + format[2]);
                    }
                } else {
                    if (start.getDay() != end.getDay()) {
                        if (yearsFirst){
                            if(daysBeforeMonths){
                                result = Ext.util.Format.date(start, format[0] + format[1]) + separator + Ext.util.Format.date(end, format[1] + format[2]);
                            } else {
                                result = Ext.util.Format.date(start, format[0] + format[1] + format[2]) + separator + Ext.util.Format.date(end, format[2]);
                            }
                        } else {
                            if(daysBeforeMonths){
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
