User
====

``User`` é o model que representa um pedido de agendamento de auditório.
Sua tabela correspondente no banco de dados se chama ``users``.

Atributos
---------

name ``VARCHAR``
  Nome do usuário.

email ``VARCHAR``
  Email do usuário, utilizado para o login. Deve ser único.

password ``VARCHAR``
  Senha do usuário, utilizada para o login.
