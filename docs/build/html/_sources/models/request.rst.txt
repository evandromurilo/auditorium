Request
=======

``Request`` é o model que representa um pedido de agendamento de auditório.
Sua tabela correspondente no banco de dados se chama ``requests``.

Atributos
---------

auditorium_id ``INTEGER``
  ID do auditório.

user_id ``INTEGER``
  ID do usuário que requisitou o agendamento.

period ``TINYINT``
  Período do agendamento:

  0. manhã
  1. tarde
  2. noite

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

Views
-----

create
  View do formulário de criação de uma nova ``Request``.

  Recebe como parâmetros GET obrigatórios a ``data`` atual e o ``id`` do auditório
  a ser agendado, além de um parâmetro opcional ``period`` com um código de período.

index
  View onde as ``Requests`` são exibidas e editadas. Recebe como parâmetro GET
  opcional um ``filter`` que pode ter um dos seguintes valores:

  all
    Todas as ``Requests`` são exibidas.

  pendent
    São exibidas somente as ``Requests`` pendentes. É o valor padrão.

  resolved
    São exibidas somente as ``Requests`` que não estão mais pendentes.

  accepted
    São exibidas somente as ``Requests`` que foram aceitas.

  rejected
    São exibidas somente as ``Requests`` que foram negadas.
