### Подключение 
В composer.json добавить

```JSON
{
    "require": {
        ...
        "idfly/yii2-sms-devinotele": "dev-master"
    },
    
    "repositories":[
        ...
        {
            "type": "git",
            "url": "git@bitbucket.org:idfly/yii2-sms-devinotele.git"
        }
    ]
}
```

Выполнить 

```
composer install
```

```
'components' => [
    ...
    'sms' => [
        'class' => 'sms\devinotele\Provider',        
        'from' => '%from%', // Один из адресов отправителя в личном кабинете: https://my.devinotele.com
        'login' => '%login%',
        'password' => '%passowrd%',
        'send_sms' => true,
        'message_lifetime' => 0, // время жизни сообщения в минутах (если не доставлено в течении установленного времени - сообщение удаляется); 0 - бесконечно
    ],
    ...
]
```

Использвоать компонент можно так:

``` \Yii::$app->sms->send($to, $text);```
