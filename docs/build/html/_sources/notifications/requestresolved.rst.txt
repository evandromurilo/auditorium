RequestResolved
===============

``RequestResolved`` é uma notificação enviada quando o status
de uma ``Request`` é modificado. É armazenada no banco de
dados e enviada via *broadcasting* no canal ``App.User.{userId}``,
para o usuário dono da ``Request``.
