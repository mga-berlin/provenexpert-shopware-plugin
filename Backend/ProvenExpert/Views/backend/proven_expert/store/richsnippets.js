
Ext.define('Shopware.apps.ProvenExpert.store.Richsnippets', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'ProvenExpert'
        };
    },
    model: 'Shopware.apps.ProvenExpert.model.Richsnippets'
});