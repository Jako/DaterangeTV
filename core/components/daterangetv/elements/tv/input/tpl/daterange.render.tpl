<input id="tv{$tv->id}" type="hidden" class="textfield"
       value="{$tv->value}" name="tv{$tv->id}"
       onblur="MODx.fireResourceFormChange();"/>
<div id="modx-daterange-tv{$tv->id}" class="daterangetv-panel-input"></div>

<script type="text/javascript">
    // <![CDATA[{literal}
    Ext.onReady(function () {
        MODx.load({{/literal}
            xtype: 'daterangetv-combo-daterangetv',
            tvId: '{$tv->id}',
            endTV: '{$params.endTV}',
            daterangeFormat: '{$params.dateFormat}' || MODx.config['manager_date_format'],
            allowBlank: {$params.allowBlank},
            daterangeStart: '{$daterange[0]}',
            daterangeEnd: '{$daterange[1]}',
            renderTo: 'modx-daterange-tv{$tv->id}'{literal}
        });
    });{/literal}
    // ]]>
</script>
