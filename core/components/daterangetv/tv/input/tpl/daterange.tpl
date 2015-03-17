<input id="tv{$tv->id}" type="hidden" class="textfield"
       value="{$tv->value}" name="tv{$tv->id}"
       onblur="MODx.fireResourceFormChange();"/>
<div id="modx-daterange-tv{$tv->id}"></div>

<script type="text/javascript">
    // <![CDATA[
    {literal}
    var params = {
        {/literal}{foreach from=$params key=k item=v name='p'}
        '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/foreach}{literal}
    };

    Ext.apply(Ext.form.VTypes, {
        daterange: function (val, field) {
            var date = field.parseDate(val);

            if (!date) {
                return false;
            }
            if (field.startDateField) {
                var start = Ext.getCmp(field.startDateField);
                if (!start.maxValue || (date.getTime() != start.maxValue.getTime())) {
                    start.setMaxValue(date);
                    start.validate();
                }
            }
            else if (field.endDateField) {
                var end = Ext.getCmp(field.endDateField);
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
        var oc = {
            'change': {
                fn: function () {
                    var fromDate = new Date(Ext.getCmp('from{/literal}{$tv->id}{literal}', 'Y-m-d').getValue());
                    var toDate = new Date(Ext.getCmp('to{/literal}{$tv->id}{literal}', 'Y-m-d').getValue());
                    var fromToDate = fromDate.format('Y-m-d') + '||';
                    if (toDate) {
                        fromToDate = fromToDate + toDate.format('Y-m-d');
                    }
                    Ext.get('tv{/literal}{$tv->id}{literal}').set({'value': fromToDate});
                    MODx.fireResourceFormChange();
                },
                scope: this
            }
        };
        var fromField = new Ext.form.DateField({
            {/literal}
            fieldLabel: '{$lang_from}',
            name: 'from{$tv->id}[]',
            id: 'from{$tv->id}',
            format: params.dateFormat || MODx.config.manager_date_format,
            dateWidth: 200,
            allowBlank: params.allowBlank,
            value: '{$daterange[0]}',
            msgTarget: 'under',
            vtype: 'daterange',
            endDateField: 'to{$tv->id}', // id of the end date field
            listeners: oc
            {literal}
        });
        var toField = new Ext.form.DateField({
            {/literal}
            fieldLabel: '{$lang_to}',
            name: 'to{$tv->id}[]',
            id: 'to{$tv->id}',
            format: params.dateFormat || MODx.config.manager_date_format,
            dateWidth: 200,
            allowBlank: true,
            value: '{$daterange[1]}',
            msgTarget: 'under',
            vtype: 'daterange',
            startDateField: 'from{$tv->id}', // id of the start date field
            listeners: oc
            {literal}
        });
        var daterangePanel = MODx.load({
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
                items: [fromField]
            }, {
                xtype: 'panel',
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                border: false,
                items: [toField]
            }],
            renderTo: 'modx-daterange-tv{$tv->id}{literal}'
        });
    });
    {/literal}
    // ]]>
</script>