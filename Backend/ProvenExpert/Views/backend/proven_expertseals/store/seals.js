
Ext.define('Shopware.apps.ProvenExpertseals.store.Seals', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'ProvenExpertseals'
        };
    },
    model: 'Shopware.apps.ProvenExpertseals.model.Seals'
});