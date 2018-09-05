
Ext.define('Shopware.apps.ProvenExpertseals', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.ProvenExpertseals',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Seals',

        'detail.Seals',
        'detail.Window'
    ],

    models: [ 'Seals' ],
    stores: [ 'Seals' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});