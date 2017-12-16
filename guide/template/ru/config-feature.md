Особенности
===

* кэш всех приложений хранится в `common/runtime`
* поумолчанию переводы берутся из `common/messages`
* `components.mailer.htmlLayout` и `components.mailer.textLayout` берутся из `yii2lab/notify/domain/mail/layouts`
* в режиме разработки, файлы отправленных писем сохраняются в `common/runtime/mail`
* очередь задач хранится в папке `@common/runtime/queue`
* RBAC хранит роли, полномочия и правила в папке `common/data/rbac`
* `components.user.identityClass` теперь не требуется, так как этот функционал берет на себя отдельный домен
* переназначены алиасы для `npm` и `bower`, так как используется другой аналог плагина **fxp**
* схема БД кэшируется только на продакшн