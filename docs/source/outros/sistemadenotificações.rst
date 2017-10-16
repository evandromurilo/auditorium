Sistema de Notificações
=======================

O sistema de notificações funciona em tempo real graças à tecnologia WebSockets;
em nossos testes, utilizamos o serviço Pusher. O componente de notificações faz uma
requisição via ajax à rota ``\notifications``, que retorna uma lista de notificações,
que é adicionada ao menu de notificações. Quando uma notificação é criada,
ou quando um evento do tipo ``NotificationRead`` é disparado, uma mensagem é
enviada via *broadcasting* no canal ``App.User.{userId}``, o que faz o componente
de notificações gerar uma nova requisição e recarregar as notificações.

Componentes
-----------

Notification.vue
****************

``Notification`` é o componente responsável por gerenciar e exibir o menu de
notificações, ele é adicionado na view ``layouts.app``.

Na função ``mounted()``, o seguinte pedaço de código é responsável por ouvir
as mensagens que chegam via WebSockets e fazer a requisição ajax para recarregar
as notificações::

    function reloadNotifications() {
        $.get("/notifications", function (data, status) {
          if (status == 'success') {
            console.log('Notifications: Reloading notifications');
            self.unreadNotifications = data;
          }
        });
    }

    Echo.private(`App.User.${this.user_id}`)
      .notification((notification) => {
        console.log('Notifications: ' + notification.type);
        reloadNotifications();
      })
      .listen('NotificationRead', (e) => {
        console.log('Notifications: App\\Events\\NotificationRead');
        reloadNotifications();
      });

NotificationItem.vue
********************

``NotificationItem`` é o componente que representa cada uma das notificações
que são exibidas no menu de notificações.
