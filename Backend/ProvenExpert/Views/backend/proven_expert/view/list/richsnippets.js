Ext.define('Shopware.apps.ProvenExpert.view.list.Richsnippets', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.richsnippets-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                pe_rsStatus: { header: 'Status' },
                pe_rsVersion: { header: 'Version' },
            },                 
            toolbar: false,
            deleteColumn: false,
            detailWindow: 'Shopware.apps.ProvenExpert.view.detail.Window'
        };
    }
});
