
Ext.define('Shopware.apps.ProvenExpertseals.model.Seals', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'ProvenExpertseals',
            detail: 'Shopware.apps.ProvenExpertseals.view.detail.Seals'
        };
    },

    fields: [
        { name : 'id',              type: 'int' },
        { name : 'pe_widgetActive', type: 'boolean' },
        { name : 'pe_type',         type: 'string' },
        { name : 'pe_style',        type: 'string' },
        { name : 'pe_feedback',     type: 'boolean' },
        { name : 'pe_avatar',       type: 'boolean' },
        { name : 'pe_competence',   type: 'boolean' },
        { name : 'pe_position',     type: 'string' },
    ]
});
