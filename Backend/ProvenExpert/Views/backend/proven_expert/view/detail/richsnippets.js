Ext.define('Shopware.apps.ProvenExpert.view.detail.Richsnippets', {
    extend: 'Shopware.model.Container',
    padding: 20,
    
    createCustomContainer: function() {
        return Shopware.Notification.createBlockMessage(
            'Bitte beachten Sie dass nur jeweils eines der RichSnippets im Frontend angezeigt werden kann. Bei mehreren aktivierten Richsnippets wird nur das erste angezeigt.',
            'info'
        );
    },

    configure: function() {
        return {
            controller: 'ProvenExpert', 
            fieldSets: 
            [
                {
                    title: '',
                    fields: 
                        {
                            pe_rsStatus: 'Status',
                            pe_rsVersion: 
                            { 
                                disabled: true,
                                fieldLabel: 'Version'
                            }                     
                        }                     
                }, 
                this.createCustomContainer,
            ]
        };
    }
});