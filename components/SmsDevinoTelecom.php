<?php

namespace sms\components;

use yii\base\Component;

class SmsDevinoTelecom extends Component
{
    public $from;

    public $login;

    public $password;

    public $send_sms;

    public $message_lifetime;

    public static $server = 'https://integrationapi.net/rest';

    public function send($to, $text)
    {
        if (empty($this->send_sms))
            return 'TEST SMS SENT (set "send_sms" to true to send real sms)';

        $sessionKey = self::getSessionKey();

        $response = self::_request('post', 'Sms/Send', [
            'SessionId' => $sessionKey,
            'SourceAddress' => $this->from,
            'DestinationAddress' => $to,
            'Data' => $text,
            'Validaty' => $this->message_lifetime,
        ]);

        return $response;
    }

    public function getSessionKey()
    {
        $sessionKey = self::_request('get', 'user/sessionid', [
            'login' => $this->login,
            'password' => $this->password,
        ]);

        if (empty($sessionKey))
            return null;

        return preg_replace('/^"(\w+)"$/', "$1", $sessionKey);
    }

    private static function _request($method, $action, $query)
    {
        $url = self::_getUrl($action, $query);
        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'post') {
            curl_setopt($request, CURLOPT_POST, true);
            curl_setopt($request, CURLOPT_POSTFIELDS, []);
        }

        $result = curl_exec($request);
        curl_close($request);

        return $result;
    }

    private static function _getUrl($action, $query)
    {
        return self::$server . '/' . $action . '?' . http_build_query($query);
    }

}