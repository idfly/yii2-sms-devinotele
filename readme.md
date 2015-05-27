### Подключение 
В composer.json добавить

```JSON
{
    "require": {
        ...
        "idfly/yii2-sms": "dev-master"
    },
    
    "repositories":[
        ...
        {
            "type": "git",
            "url": "git@bitbucket.org:idfly/yii2-sms.git"
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
        'class' => 'sms\components\SmsDevinoTelecom',        
        'from' => '%from%', // TODO: need example
        'login' => '%login%',
        'password' => '%passowrd%',
        'send_sms' => true,
        'message_lifetime' => '?', // TODO: need example
    ],
    ...
]
```