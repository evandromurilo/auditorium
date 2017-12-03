Call
====

``Call`` é o model que representa uma chamada. Sua tabela correspondente
no banco de dados se chama ``calls``.

Atributos
---------

title ``VARCHAR(40)``
  Título da chamada.

user_to_user ``TINYINT``
  Se é uma chamada de um para um.

Componentes
-----------

Call.vue
  Componente principal de uma chamada. 

CallMember.vue
  Componente que representa um usuário na lista de usuários na chamada.

CallMessage.vue
  Componente que representa uma mensagem na lista de mensagens na chamada.

NewCall.vue
  Componente para criação de chamadas.
