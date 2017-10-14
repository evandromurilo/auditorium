User
====

``User`` é o model que representa um usuário. Sua tabela correspondente no banco de dados
se chama ``users``.

Atributos
---------

name ``VARCHAR``
  Nome do usuário.

email ``VARCHAR``
  Email do usuário, utilizado para o login. Deve ser único.

password ``VARCHAR``
  Senha do usuário, utilizada para o login.

description ``TEXT``
  Descrição do usuário, idealmente seu cargo. Ex.: "Coordenador de Sistemas de Informação".

color ``CHAR(7)``
  Código de cor do avatar do usuário em formato hexadecimal.

cel ``VARCHAR(19)``
  Número de telefone do usuário.

Views
-----

show
  Perfil do usuário.
