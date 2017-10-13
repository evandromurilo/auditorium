Auditorium
==========

``Auditorium`` é o model que representa um auditório. Sua tabela correspondente
no banco de dados se chama ``auditoria``.

Atributos
---------

name ``VARCHAR(20)``
  Nome do auditório

capacity ``INTEGER``
  Quantas pessoas o auditório comporta.

accessible ``BOOLEAN``
  Se o auditório preenche os requisitos de acessibilidade.

local ``VARCHAR(100)``
  Localização do auditório.

obs ``TEXT``
  Observações adicionais sobre o auditório.

Métodos
-------

statusOn( ``Carbon $date`` )
  Retorna um objeto ``Status`` representando o status do auditório na data ``$date``.

  Ver: :doc:`/helpers/status`.

Views
-----

index
  View onde são exibidos todos os auditórios e seus status para determinado dia.

  Recebe como parâmetro GET opcional uma ``data``. Caso nenhuma seja fornecida, utiliza
  a data atual.
