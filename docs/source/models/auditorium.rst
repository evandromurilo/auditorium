Auditorium
==========

``Auditorium`` é o model que representa um auditório. Sua tabela correspondente
no banco de dados se chama ``auditoria``.

Atributos
*********

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
