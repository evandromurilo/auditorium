Status
======

A classe ``Status`` representa o status de um auditório em uma data específica.

Atributos
---------

**morning**, **afternoon** e **night** representam o status do auditório no determinado
período:

0. pendente
1. disponível
2. indisponível

morning ``Int``
  Representa o status do auditório no período da manhã.

afternoon ``Int``
  Representa o status do auditório no período da tarde.

night ``Int``
  Representa o status do auditório no período da noite.

date ``Carbon``
  A data do ``Status`` em questão.

requests ``Collection``
  Uma ``Collection`` contendo todas as ``Requests`` existentes para o auditório
  em questão.

morning_requests ``Collection``
  Uma ``Collection`` contendo todas as ``Requests`` existentes para o auditório
  em questão no período da manhã.

afternoon_requests ``Collection``
  Uma ``Collection`` contendo todas as ``Requests`` existentes para o auditório
  em questão no período da tarde.

night_requests ``Collection``
  Uma ``Collection`` contendo todas as ``Requests`` existentes para o auditório
  em questão no período da noite.

Exemplo
-------
::

  // retorna o código de status do auditório no período da noite de hoje
  $auditorium->statusOn(Carbon::now())->night

