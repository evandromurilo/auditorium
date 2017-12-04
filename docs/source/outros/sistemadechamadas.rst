Sistema de Chamadas
===================

O Sistema de Chamadas permite que sejam criadas janelas de chat entre vários usuários.
Assim como o Sistema de Notificações, funciona em tempo real graças à tecnologia WebSockets;
O componente de chamada faz diversas requisições via ajax para atualizar as chamadas sem a
necessidade de recarregar a página.

Quando uma mensagem é criada, um evento do tipo ``MessageCreated`` é disparado e enviado
via *broadcasting* ao canal ``App.Call.{callId}``. O componente de chamada, então, lida com
a atualização das mensagens.

Componentes
-----------

Call.vue
********

Componente responsável por gerenciar uma chamada. Os métodos ``refresh`` e ``load``
lidam com as requisições ajax, enquanto o método ``ListenOnEcho`` ouve no canal
``App.Call.{callId}``.

CallMember.vue
**************

Componente que representa um usuário na lista de usuários na chamada.

CallMessage.vue
***************

Componente que representa uma mensagem na lista de mensagens na chamada.

NewCall.vue
***********

Componente para criação de chamadas.
