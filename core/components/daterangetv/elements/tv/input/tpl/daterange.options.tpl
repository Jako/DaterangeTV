<script type="text/javascript">
    // <![CDATA[{literal}
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
        applyTo: 'modx-input-props',
        border: false,
        labelAlign: 'top',
        listeners: {
            afterrender: function (component) {
                Ext.getCmp('modx-panel-tv-input-properties').addListener('resize', function () {
                    component.setWidth(Ext.getCmp('modx-input-props').getWidth()).doLayout();
                });
            }
        },
        items: [{
            xtype: 'combo-boolean',
            fieldLabel: _('required'),
            description: MODx.expandHelp ? '' : _('required_desc'),
            name: 'inopt_allowBlank',
            hiddenName: 'inopt_allowBlank',
            id: 'inopt_allowBlank{/literal}{$tv}{literal}',
            value: !(params['allowBlank'] === 0 || params['allowBlank'] === 'false'),
            anchor: '100%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'inopt_allowBlank{/literal}{$tv}{literal}',
            html: _('required_desc'),
            cls: 'desc-under'
        }, {
            layout: 'column',
            items: [{
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('daterangetv.dateFormat'),
                    description: MODx.expandHelp ? '' : _('daterangetv.dateFormatDesc'),
                    name: 'inopt_dateFormat',
                    id: 'inopt_dateFormat{/literal}{$tv}{literal}',
                    value: params['dateFormat'] || '',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_dateFormat{/literal}{$tv}{literal}',
                    html: _('daterangetv.dateFormatDesc'),
                    cls: 'desc-under'
                }]
            }, {
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'daterangetv-combo-tv',
                    fieldLabel: _('daterangetv.endTV'),
                    description: MODx.expandHelp ? '' : _('daterangetv.endTVDesc'),
                    name: 'inopt_endTV',
                    hiddenName: 'inopt_endTV',
                    id: 'inopt_endTV{/literal}{$tv}{literal}',
                    value: params['endTV'] || '',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_endTV{/literal}{$tv}{literal}',
                    html: _('daterangetv.endTVDesc'),
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
                            '&copy; 2013-2020 by <a href="https://treehillstudio.com" target="_blank">treehillstudio.com</a></span>';
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
        }],
        renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
    });
    // ]]>
</script>
{/literal}
