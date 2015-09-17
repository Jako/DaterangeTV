<input id="tv{$tv->id}" type="hidden" class="textfield"
       value="{$tv->value}" name="tv{$tv->id}"
       onblur="MODx.fireResourceFormChange();"/>
<div id="modx-daterange-tv{$tv->id}"></div>

<script type="text/javascript">
    // <![CDATA[
    {literal}
    var daterangeParams = {
        {/literal}{foreach from=$params key=k item=v name='p'}
        '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/foreach}{literal}
    };
    var daterangeFormat = daterangeParams.dateFormat || MODx.config['manager_date_format'];

    Ext.apply(Ext.form.VTypes, {
        daterange: function (val, field) {
            var date = field.parseDate(val);
            if (!date) {
                return false;
            }
            var start = Ext.getCmp(field.startDateField);
            var end = Ext.getCmp(field.endDateField);
            if (start) {
                if (!start.maxValue || (date.getTime() != start.maxValue.getTime())) {
                    start.setMaxValue(date);
                    start.validate();
                }
            }
            if (end) {
                if (!end.minValue || (date.getTime() != end.minValue.getTime())) {
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

    Ext.onReady(function () {
        var daterangeOnChange = {
            'change': {
                fn: function () {
                    var oldFromToDate = Ext.get('tv{/literal}{$tv->id}{literal}').getValue();
                    var from = Ext.getCmp('from{/literal}{$tv->id}{literal}', daterangeFormat).getValue();
                    var fromDate = new Date(from);
                    var to = Ext.getCmp('to{/literal}{$tv->id}{literal}', daterangeFormat).getValue();
                    var toDate = new Date(to);

                    var fromToDate = '';
                    if (from) {
                        fromToDate = fromDate.format('Y-m-d') + '||';
                        if (to) {
                            fromToDate = fromToDate + toDate.format('Y-m-d');
                        }
                    }

                    Ext.get('tv{/literal}{$tv->id}{literal}').set({'value': fromToDate});
                    if (oldFromToDate != fromToDate) {
                        MODx.fireResourceFormChange();
                    }
                },
                scope: this
            }
        };
        var daterangeFromField = new Ext.form.DateField({
            {/literal}
            fieldLabel: _('daterangetv.from'),
            name: 'from{$tv->id}[]',
            id: 'from{$tv->id}',
            format: daterangeFormat,
            dateWidth: 200,
            allowBlank: daterangeParams.allowBlank,
            value: '{$daterange[0]}',
            msgTarget: 'under',
            vtype: 'daterange',
            endDateField: 'to{$tv->id}', // id of the end date field
            listeners: daterangeOnChange
            {literal}
        });
        var daterangeToField = new Ext.form.DateField({
            {/literal}
            fieldLabel: _('daterangetv.to'),
            name: 'to{$tv->id}[]',
            id: 'to{$tv->id}',
            format: daterangeFormat,
            dateWidth: 200,
            allowBlank: true,
            value: '{$daterange[1]}',
            msgTarget: 'under',
            vtype: 'daterange',
            startDateField: 'from{$tv->id}', // id of the start date field
            listeners: daterangeOnChange
            {literal}
        });
        MODx.load({
            {/literal}
            xtype: 'panel',
            layout: 'column',
            autoHeight: true,
            border: false,
            bodyStyle: 'padding-top: 4px',
            width: 300,
            items: [{
                xtype: 'panel',
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                border: false,
                items: [daterangeFromField]
            }, {
                xtype: 'panel',
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                border: false,
                items: [daterangeToField]
            }],
            renderTo: 'modx-daterange-tv{$tv->id}{literal}'
        });
    });
    {/literal}
    // ]]>
</script>