<div id="tv-output-properties-form{$tv}"></div>
{literal}

<script type="text/javascript">
    // <![CDATA[
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
        labelAlign: 'top',
        cls: 'form-with-labels',
        border: false,
        items: [{
            xtype: 'textfield',
            fieldLabel: '{/literal}{$daterangetv.dateOutputFormat}{literal}',
            description: MODx.expandHelp ? '' : '{/literal}{$daterangetv.dateOutputFormatDesc}{literal}',
            name: 'prop_format',
            id: 'prop_format{/literal}{$tv}{literal}',
            value: params['format'] || '%e| %B |%Y',
            listeners: oc,
            width: 200
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
            listeners: oc,
            width: 200
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
            listeners: oc,
            width: 200
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
