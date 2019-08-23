var daterangeTV = function (config) {
    config = config || {};
    daterangeTV.superclass.constructor.call(this, config);
};

Ext.extend(daterangeTV, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, jquery: {}, form: {}
});
Ext.reg('daterangetv', daterangeTV);

DaterangeTV = new daterangeTV();
