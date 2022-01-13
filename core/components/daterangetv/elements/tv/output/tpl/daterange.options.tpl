<script type="text/javascript">
    // <![CDATA[{literal}
    var params = {
        {/literal}{foreach from=$params key=k item=v name='p'}
        '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/foreach}{literal}
    };
    var oc = {
        change: {
            fn: function () {
                Ext.getCmp('modx-panel-tv').markDirty();
            }, scope: this
        }
    };
    MODx.load({
        xtype: 'panel',
        layout: 'form',
        applyTo: 'modx-widget-props',
        cls: 'daterangetv-props',
        border: false,
        labelAlign: 'top',
        listeners: {
            afterrender: function (component) {
                Ext.getCmp('modx-panel-tv-output-properties').addListener('resize', function () {
                    component.setWidth(Ext.getCmp('modx-widget-props').getWidth()).doLayout();
                });
                Ext.getCmp('modx-tv-tabs').addListener('tabchange', function () {
                    component.setWidth(Ext.getCmp('modx-widget-props').getWidth()).doLayout();
                });
            },
        },
        items: [{
            layout: 'column',
            items: [{
                columnWidth: .33,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('daterangetv.dateOutputFormat'),
                    description: MODx.expandHelp ? '' : _('daterangetv.dateOutputFormatDesc'),
                    name: 'prop_format',
                    id: 'prop_format{/literal}{$tv}{literal}',
                    value: params['format'] || '%e.| %B |%Y',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'prop_format{/literal}{$tv}{literal}',
                    html: _('daterangetv.dateOutputFormatDesc'),
                    cls: 'desc-under'
                }]
            }, {
                columnWidth: .33,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('daterangetv.separatorOutput'),
                    description: MODx.expandHelp ? '' : _('daterangetv.separatorOutputDesc'),
                    name: 'prop_separator',
                    id: 'prop_separator{/literal}{$tv}{literal}',
                    value: params['separator'] || '&thinsp;–&thinsp;',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'prop_separator{/literal}{$tv}{literal}',
                    html: _('daterangetv.separatorOutputDesc'),
                    cls: 'desc-under'
                }]
            }, {
                columnWidth: .34,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('daterangetv.localeOutput'),
                    description: MODx.expandHelp ? '' : _('daterangetv.localeOutputDesc'),
                    name: 'prop_locale',
                    id: 'prop_locale{/literal}{$tv}{literal}',
                    value: params['locale'] || '',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'prop_locale{/literal}{$tv}{literal}',
                    html: _('daterangetv.localeOutputDesc'),
                    cls: 'desc-under'
                }]
            }]
        }, {
            cls: "treehillstudio_about",
            html: '<img width="146" height="40" src="' + DaterangeTV.config.assetsUrl + 'img/treehill-studio-small.png"' + ' srcset="' + DaterangeTV.config.assetsUrl + 'img/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function (component) {
                    component.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center"><img src="' + DaterangeTV.config.assetsUrl + 'img/treehill-studio.png" srcset="' + DaterangeTV.config.assetsUrl + 'img/treehill-studio@2x.png 2x" alt="Treehill Studio"><br>' +
                            '&copy; 2013-2022 by <a href="https://treehillstudio.com" target="_blank">treehillstudio.com</a></span>';
                        Ext.Msg.show({
                            title: _('daterangetv') + ' ' + DaterangeTV.config.version,
                            msg: msg,
                            buttons: Ext.Msg.OK,
                            cls: 'treehillstudio_window',
                            width: 358
                        });
                    });
                }
            }
        }]
    });
    MODx.helpUrl = 'https://jako.github.io/DaterangeTV/usage/';
    // ]]>
</script>
{/literal}
