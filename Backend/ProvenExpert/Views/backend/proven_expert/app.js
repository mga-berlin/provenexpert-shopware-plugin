
Ext.define('Shopware.apps.ProvenExpert', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.ProvenExpert',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Richsnippets',

        'detail.Richsnippets',
        'detail.Window'
    ],

    models: [ 'Richsnippets' ],
    stores: [ 'Richsnippets' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});