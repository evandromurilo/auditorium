NewRequest
==========

``NewRequest`` é uma notificação enviada quando um novo pedido
de auditório é feito. É armazenada no banco de dados e enviada via *broadcasting*
no canal ``App.User.{userId}``, para todos os usuários do tipo secretário.
