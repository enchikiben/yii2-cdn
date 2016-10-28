# yii2-cdn

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
php composer.phar require --prefer-dist "enchikiben/yii2-cdn" "*"
```
or

```json
"enchikiben/yii2-cdn" : "*"
```

Configure
---------

```php
'components' => [
    'cdn' => [
        'class' => 'enchikiben\cdn\CDNComponent',
        'domains' => [
            '//static.example.com',
            '//static2.example.com',
            '//static2.example.com'
        ]
    ]
],
```

and

```php
'bootstrap' => [
    'cdn'
],
```
