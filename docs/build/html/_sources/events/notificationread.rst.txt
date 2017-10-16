NotificationRead
================

``NotificationRead`` é um evento disparado quando uma notificação é lida. É enviado
via *broadcast* no canal ``App.User.{userId}``.

Atributos
---------

user ``User``
  O usuário que leu a notificação.
