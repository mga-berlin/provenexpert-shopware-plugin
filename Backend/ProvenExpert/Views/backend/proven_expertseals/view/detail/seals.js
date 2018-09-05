

Ext.define('Shopware.apps.ProvenExpertseals.view.detail.Seals', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        return {
            controller: 'ProvenExpertseals',
            fieldSets: 
            [
                {
                    title: '',
                    fields: 
                        {
                            pe_widgetActive: 'Status',
                            pe_type: 
                            { 
                                disabled: true,
                                fieldLabel: 'Version',
                            }                     
                        }                     
                },
                {
                    title: 'Nur bei "Portrait", "Bar" und "Landing"',
                    fields:
                           {
                               pe_feedback:    'Feedback',
                           }
                },
                {
                    title: 'Nur bei "Bar" und "Landing"',
                    fields:
                           {
                               pe_style:
                               {
                                   fieldLabel: 'Style',
                                   editable: false,
                                   xtype: 'combobox',
                                   store: [
                                       ['white', 'white'],
                                       ['black', 'black'],
                                   ]
                               },
                           }
                },
                {
                    title: 'Nur bei "Landing"',
                    fields: 
                        {
                            pe_competence:  'Competences',
                            pe_avatar:      'Avatar',
                        }                     
                },                 
            ]            
        };
    }
});