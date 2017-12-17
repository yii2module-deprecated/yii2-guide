Меню
===

Файлы с данными для формирования гланых меню для админки и сайта находятся в `common/data/menu`.

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
			'access' => PermissionEnum::ARTICLE_POST_MANAGE,
		],
	],
];
```

* `label` - название пункта. Может быть строкой или массивом
* `url` - ссылка
* `icon` - иконка (fa)
* `module` - модуль. Если модуль будет отключен, то пункт отображаться не будет
* `access` - массив полномочий

Можно формировать меню из класса:

```php
'rightMenu' => [
		[
			'module' => 'user',
			'class' => 'yii2woop\account\module\helpers\Navigation',
		],
	],
```

Класс генерирует массив для формирования пункта.