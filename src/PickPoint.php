<?php

namespace Domatskiy;

use Domatskiy\PickPoint\RequestResult;

class PickPoint
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    private $api_url = 'https://e-solution.pickpoint.ru/api';
    private $login;
    private $passw;
    private $session_id;
    private $is_test = false;

    # Тестовая версия https://e-solution.pickpoint.ru/apitest/
    # Логин:	apitest
    # Пароль: apitest


    /**
     * Request constructor.
     * @throws \Exception
     */
    function __construct($login, $passw, $test = false)
    {
        $this->is_test = $test;

        if($this->is_test)
        {
            $login = 'apitest';
            $passw = 'apitest';
        }

        $this->login = $login;
        $this->passw = $passw;

        if($test)
            $this->api_url = 'https://e-solution.pickpoint.ru/apitest';

    }

    /**
     * @param array $data
     * @return RequestResult
     */
    private function __request($method, $url, array $data = array())
    {
        if($this->session_id)
            $data["SessionId"]= $this->session_id;

        $result = new RequestResult();
        $result_data = array();

        $d = array();

        foreach($data as $key => $val)
            $d[] = $key.'='.urlencode($val);

        $full_url = $this->api_url.$url;

        if($method == self::METHOD_GET)
            $full_url .= $d ? '?'.http_build_query($d) : '';

        $result->setUrl($full_url);

        #в запросе указывать Content type равным “application/json”,
        #​ таймаут ожидания выполнения запроса 60 секунд,

        $options = [
            #'form_params' => $data,
            #'body' => $data,
            ];

        $client = new \GuzzleHttp\Client();

        $res = $client->request($method, $full_url, [
            'headers' => ['Content-Type: application/json'],
            'timeout' => 60,
            'http_errors' => false,
            'json' => $data
            ]);

        if($res->getStatusCode() == 200)
        {
            try{
                $result_data = (array)json_decode($res->getBody());

                if(!is_array($result_data))
                    $result_data = array();

            }
            catch (\Exception $e)
            {
                echo 'Exception: '.$e->getMessage();
                $result->setError($e->getCode(), $e->getMessage());
            }

        }
        else
        {
            echo 'Status code '.$res->getBody();
            $result->setError($res->getStatusCode(), 'Err: '.$res->getBody());
        }

        var_dump($result_data);

        $result->setData($result_data);

        return $result; // $res->getBody()
    }

    /**
     * @param $login
     * @param $passw
     * @return RequestResult
     */
    public function login()
    {
        $result = $this->__request(self::METHOD_POST, '/login', [
            'login' => $this->login,
            'password' => $this->passw
            ]);

        $data = $result->getData();

        if(isset($data['SessionId']))
            $this->session_id = $data['SessionId'];
        else
            $result->setError(0, '');

        return $result;
    }

    public function logout()
    {

    }
}