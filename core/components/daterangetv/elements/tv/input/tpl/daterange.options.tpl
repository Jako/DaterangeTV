<div id="tv-input-properties-form{$tv}"></div>
<script type="text/javascript">
    // <![CDATA[
    {literal}
    var params = {
        {/literal}{foreach from=$params key=k item=v name='p'}
        '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/foreach}{literal}
    };
    var oc = {
        'change': {
            fn: function () {
                Ext.getCmp('modx-panel-tv').markDirty();
            }, scope: this
        }
    };
    MODx.load({
        xtype: 'panel',
        layout: 'form',
        autoHeight: true,
        cls: 'form-with-labels',
        border: false,
        labelAlign: 'top',
        items: [{
            xtype: 'combo-boolean',
            fieldLabel: _('required'),
            description: MODx.expandHelp ? '' : _('required_desc'),
            name: 'inopt_allowBlank',
            hiddenName: 'inopt_allowBlank',
            id: 'inopt_allowBlank{/literal}{$tv}{literal}',
            value: !(params['allowBlank'] == 0 || params['allowBlank'] == 'false'),
            anchors: '98%',
            width: '99%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'inopt_allowBlank{/literal}{$tv}{literal}',
            html: _('required_desc'),
            cls: 'desc-under'
        }, {
            xtype: 'textfield',
            fieldLabel: '{/literal}{$daterangetv.dateFormat}{literal}',
            description: MODx.expandHelp ? '' : '{/literal}{$daterangetv.dateFormatDesc}{literal}',
            name: 'inopt_dateFormat',
            id: 'inopt_dateFormat{/literal}{$tv}{literal}',
            value: params['dateFormat'] || '',
            anchors: '98%',
            width: '99%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'inopt_dateFormat{/literal}{$tv}{literal}',
            html: '{/literal}{$daterangetv.dateFormatDesc}{literal}',
            cls: 'desc-under'
        }],
        renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
    });
    // ]]>
</script>
{/literal}
