
Ext.define('Shopware.apps.ProvenExpert.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.richsnippets-list-window',
    height: 450,
    title : '{s name=window_title}Richsnippets{/s}',

    configure: function() {
        return {       
            listingGrid: 'Shopware.apps.ProvenExpert.view.list.Richsnippets',
            listingStore: 'Shopware.apps.ProvenExpert.store.Richsnippets'
        };
    }
});