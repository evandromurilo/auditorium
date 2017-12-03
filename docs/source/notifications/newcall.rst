NewCall
=======

``NewCall`` é uma notificação enviada quando uma nova chamada
é criada. É armazenada no banco de dados e enviada via *broadcasting*
no canal ``App.User.{userId}``, para todos os usuários envolvidos na
chamada.
