

Ext.define('Shopware.apps.ProvenExpertseals.view.list.Seals', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.seals-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                pe_widgetActive: { header: 'Status' },
                pe_type: { header: 'Version' },
            },                 
            toolbar: false,
            deleteColumn: false,            
            detailWindow: 'Shopware.apps.ProvenExpertseals.view.detail.Window'
        };
    }
});
