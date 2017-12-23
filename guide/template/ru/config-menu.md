Меню
===

Файлы с данными для формирования гланых меню для админки и сайта находятся в `common/data/menu`.

NavBar настраивается в файлах:

* common\data\menu\navbar_backend.php
* common\data\menu\navbar_frontend.php

Это php- файлы возвращающие массив пунктов меню.

Например, для описания ссылки достаточно написать:

```php
return [
	'mainMenu' => [
		[
			'label' => ['article/main', 'title'],
			'url' => 'article/manage',
			'icon' => 'square-o',
			'module' => 'article',
			'domain' => 'article'
			'access' => PermissionEnum::ARTICLE_POST_MANAGE,
		],
	],
];
```

* `label` - надпись пункта (строка или массив)
* `url` - ссылка
* `icon` - иконка (fa)
* `module` - модуль. Если модуль отключен, пункт отображаться не будет
* `domain` - домен. Если домен отключен, пункт отображаться не будет
* `access` - полномочия (строка или массив)
* `items` - дочерние пункты
* `hide` - скрыть пункт
* `visible` - наоборот, показать пункт
* `js` - JS-код выполняемый при клике
* `active` - активный ли пункт

Пример пункта с дочерними пунктами:

```php
return [
	'rightMenu' => [
		[
			'label' => ['notify/main', 'title'],
			'icon' => 'bell',
			'items' => [
				[
					'label' => ['notify/main', 'sms'],
					'url' => 'notify/send/sms',
				],
				[
					'label' => ['notify/main', 'email'],
					'url' => 'notify/send/email',
				],
				[
					'label' => ['notify/cron', 'title'],
					'url' => 'notify/cron',
				],
			],
		],
	],
];
```

Можно формировать меню из класса:

```php
return [
	'rightMenu' => [
		[
			'module' => 'user',
			'class' => 'yii2woop\account\module\helpers\Navigation',
		],
	],
];
```

Класс генерирует массив для формирования пункта.