<div id="tv-output-properties-form{$tv}"></div>
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
            xtype: 'textfield',
            fieldLabel: '{/literal}{$daterangetv.dateOutputFormat}{literal}',
            description: MODx.expandHelp ? '' : '{/literal}{$daterangetv.dateOutputFormatDesc}{literal}',
            name: 'prop_format',
            id: 'prop_format{/literal}{$tv}{literal}',
            value: params['format'] || '%e| %B |%Y',
            anchors: '98%',
            width: '99%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'prop_format{/literal}{$tv}{literal}',
            html: '{/literal}{$daterangetv.dateOutputFormatDesc}{literal}',
            cls: 'desc-under'
        }, {
            xtype: 'textfield',
            fieldLabel: '{/literal}{$daterangetv.separatorOutput}{literal}',
            description: MODx.expandHelp ? '' : '{/literal}{$daterangetv.separatorOutputDesc}{literal}',
            name: 'prop_separator',
            id: 'prop_separator{/literal}{$tv}{literal}',
            value: params['separator'] || ' – ',
            anchors: '98%',
            width: '99%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'prop_separator{/literal}{$tv}{literal}',
            html: '{/literal}{$daterangetv.separatorOutputDesc}{literal}',
            cls: 'desc-under'
        }, {
            xtype: 'textfield',
            fieldLabel: '{/literal}{$daterangetv.localeOutput}{literal}',
            description: MODx.expandHelp ? '' : '{/literal}{$daterangetv.localeOutputDesc}{literal}',
            name: 'prop_locale',
            id: 'prop_locale{/literal}{$tv}{literal}',
            value: params['locale'] || '',
            anchors: '98%',
            width: '99%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'prop_locale{/literal}{$tv}{literal}',
            html: '{/literal}{$daterangetv.localeOutputDesc}{literal}',
            cls: 'desc-under'
        }],
        renderTo: 'tv-output-properties-form{/literal}{$tv}{literal}'
    });
    // ]]>
</script>
{/literal}
