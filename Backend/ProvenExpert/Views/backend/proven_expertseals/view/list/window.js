
Ext.define('Shopware.apps.ProvenExpertseals.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.seals-list-window',
    height: 450,
    title : '{s name=window_title}Seals listing{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.ProvenExpertseals.view.list.Seals',
            listingStore: 'Shopware.apps.ProvenExpertseals.store.Seals'
        };
    }
});