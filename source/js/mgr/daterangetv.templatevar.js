DaterangeTV.combo.TV = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'tv',
        hiddenName: 'tv',
        displayField: 'name',
        valueField: 'id',
        fields: ['name', 'id'],
        pageSize: 20,
        url: DaterangeTV.config.connectorUrl,
        baseParams: {
            action: 'mgr/tvs/getlist',
            combo: true
        }
    });
    DaterangeTV.combo.TV.superclass.constructor.call(this, config);
};
Ext.extend(DaterangeTV.combo.TV, MODx.combo.ComboBox);
Ext.reg('daterangetv-combo-tv', DaterangeTV.combo.TV);

Ext.apply(Ext.form.VTypes, {
    daterange: function (val, field) {
        var date = field.parseDate(val);
        if (!date) {
            return false;
        }
        var start = Ext.getCmp(field.startDateField);
        var end = Ext.getCmp(field.endDateField);
        if (start) {
            if (!start.maxValue || (date.getTime() !== start.maxValue.getTime())) {
                start.setMaxValue(date);
                start.validate();
            }
        }
        if (end) {
            if (!end.minValue || (date.getTime() !== end.minValue.getTime())) {
                end.setMinValue(date);
                end.validate();
            }
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    }
});

DaterangeTV.combo.DaterangeTV = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype: 'panel',
        layout: 'column',
        autoHeight: true,
        border: false,
        width: 400,
        items: [{
            xtype: 'panel',
            columnWidth: .5,
            layout: 'form',
            labelAlign: 'top',
            border: false,
            items: [
                new Ext.form.DateField({
                    fieldLabel: _('daterangetv.from'),
                    name: 'from' + config.tvId + '[]',
                    id: 'from' + config.tvId,
                    format: config.daterangeFormat,
                    dateWidth: 200,
                    allowBlank: config.allowBlank,
                    value: config.daterangeStart,
                    msgTarget: 'under',
                    vtype: 'daterange',
                    labelStyle: 'padding-top:4px',
                    endDateField: 'to' + config.tvId, // id of the end date field
                    listeners: {
                        change: {
                            fn: this.daterangeOnChange,
                            scope: this
                        }
                    }
                })
            ]
        }, {
            xtype: 'panel',
            columnWidth: .5,
            layout: 'form',
            labelAlign: 'top',
            border: false,
            items: [
                new Ext.form.DateField({
                    fieldLabel: _('daterangetv.to'),
                    name: 'to' + config.tvId + '[]',
                    id: 'to' + config.tvId,
                    format: config.daterangeFormat,
                    dateWidth: 200,
                    allowBlank: true,
                    value: config.daterangeEnd,
                    msgTarget: 'under',
                    vtype: 'daterange',
                    labelStyle: 'padding-top:4px',
                    startDateField: 'from' + config.tvId, // id of the start date field
                    listeners: {
                        change: {
                            fn: this.daterangeOnChange,
                            scope: this
                        }
                    }
                })
            ]
        }]
    });
    DaterangeTV.combo.DaterangeTV.superclass.constructor.call(this, config);
};
Ext.extend(DaterangeTV.combo.DaterangeTV, MODx.Panel, {
    daterangeOnChange: function () {
        var values = {
            from: Ext.getCmp('from' + this.config.tvId, this.config.daterangeFormat).getValue(),
            to: Ext.getCmp('to' + this.config.tvId, this.config.daterangeFormat).getValue()
        };
        this.setTVValue(values);
    },
    setTVValue: function (values) {
        var oldFromToDate = this.getTVValue();
        var fromDate = '';
        var toDate = '';
        var fromToDate = '';
        if (values.from) {
            fromDate = new Date(values.from).format('Y-m-d');
            fromToDate = fromDate + '||';
            if (values.to) {
                toDate = new Date(values.to).format('Y-m-d');
                fromToDate = fromToDate + toDate;
            }
        }
        if (this.config.endTV && Ext.get('tv' + this.config.endTV)) {
            Ext.get('tv' + this.config.tvId).set({'value': fromDate});
            Ext.get('tv' + this.config.endTV).set({'value': toDate});
        } else {
            Ext.get('tv' + this.config.tvId).set({'value': fromToDate});
        }
        if (oldFromToDate !== fromToDate) {
            MODx.fireResourceFormChange();
        }
    },
    getTVValue: function () {
        var fromToDate = Ext.get('tv' + this.config.tvId).getValue();
        if (this.config.endTV && Ext.get('tv' + this.config.endTV)) {
            var toDate = Ext.get('tv' + this.config.endTV).getValue();
            if (toDate) {
                fromToDate = fromToDate + '||' + Ext.get('tv' + this.config.endTV).getValue();
            }
        }
        return fromToDate;
    }
});
Ext.reg('daterangetv-combo-daterangetv', DaterangeTV.combo.DaterangeTV);
