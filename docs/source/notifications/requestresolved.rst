RequestResolved
===============

``RequestResolved`` é uma notificação enviada quando o status
de uma ``Request`` é modificado. É armazenada no banco de
dados e enviada via *broadcasting* no canal ``App.User.{userId}``.

Atributos via Broadcast
-----------------------
created_at ``String``
  Data e hora da criação da notificação.

data.request_id ``Int``
  ID da ``Request`` que teve o status modificado.

data.auditorium_name ``String``
  Nome do ``Auditorium`` requisitado na ``Request``.
