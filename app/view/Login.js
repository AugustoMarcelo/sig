Ext.define('Packt.view.Login', {
    extend: 'Ext.window.Window',
    alias: 'widget.login',

    requires: [
        'Packt.view.Translation'
    ],
    autoShow: true,
    height: 170,
    width: 360,
    layout: {
        type: 'fit'
    },
    iconCls: 'key',
    title: translations.login,
    closeAction: 'hide',
    closable: false,
    resizable: false,
    draggable: false,
    items: [
        {
            xtype: 'form',
            frame: false,
            bodyPadding: 15,
            defaults: {
                xtype: 'textfield',
                anchor: '100%',
                labelWidth: 60,
                allowBlank: false,
                minLength: 3,
                msgTarget: 'under'
            },
            items: [
                {
                    name: 'user',
                    fieldLabel: translations.usuario,
                    maxLength: 25,
                    cls: 'nomeUsuario',
                    vtype: 'alphanum'
                },
                {
                    inputType: 'password',
                    name: 'password',
                    fieldLabel: translations.password,
                    maxLength: 25,
                    enableKeyEvents: true,
                    id: 'password'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                            xtype: 'translation'
                        },
                        {
                            xtype: 'tbfill'
                        },
                        {
                            xtype: 'button',
                            itemId: 'cancel',
                            iconCls: 'cancel',
                            text: translations.limpar
                        },
                        {
                            xtype: 'button',
                            itemId: 'submit',
                            formBind: true,
                            iconCls: 'key_go',
                            text: translations.submit
                        }
                    ]
                }
            ]
        }
    ]
});