Request
=======

``Request`` é o model que representa um pedido de agendamento de auditório.
Sua tabela correspondente no banco de dados se chama ``requests``.

Atributos
*********

auditorium_id ``INTEGER``
  ID do auditório.

user_id ``INTEGER``
  ID do usuário que requisitou o agendamento.

from_time ``TIME``
  Horário inicial do agendamento.

to_time ``TIME``
  Horário final do agendamento.

date ``DATE``
  Data do agendamento.

event ``VARCHAR(100)``
  Nome que identifica o agendamento, preferencialmente o nome do
  evento.

description ``TEXT``
  Descrição do pedido de agendamento.

status ``TINYINT``
  Status do pedido:

  0. pendente
  1. rejeitado
  2. aceito
