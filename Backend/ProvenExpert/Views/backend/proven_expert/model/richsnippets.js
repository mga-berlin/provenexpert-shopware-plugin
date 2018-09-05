
Ext.define('Shopware.apps.ProvenExpert.model.Richsnippets', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'ProvenExpert',
            detail: 'Shopware.apps.ProvenExpert.view.detail.Richsnippets'
        };
    },


    fields: [
        { name : 'id', type: 'int' },
        { name : 'pe_rsApiScriptVersion', type: 'string' },
        { name : 'pe_rsStatus', type: 'boolean' },
        { name : 'pe_rsVersion', type: 'string' },
    ]
});

