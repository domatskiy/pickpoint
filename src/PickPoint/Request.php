<?php

namespace Domatskiy\PickPoint;


abstract class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    protected $api_url = 'https://e-solution.pickpoint.ru/api';

    # Тестовая версия https://e-solution.pickpoint.ru/apitest/
    # Логин:	apitest
    # Пароль: apitest

    protected $is_test = false;
    protected $session_id = '';

    /**
     * Request constructor.
     * @param $session_id
     * @param $is_test
     */
    function __construct($session_id, $is_test)
    {
        $this->session_id = $session_id;

        $this->is_test = $is_test;

        if($this->is_test)
            $this->api_url = 'https://e-solution.pickpoint.ru/apitest';
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
        return $this->session_id;
    }

    /**
     * @param $session_id
     */
    public function setSessionID($session_id)
    {
        $this->session_id = $session_id;
    }

    /**
     * @param $method
     * @param $url
     * @param array $data
     * @return RequestResult
     */
    protected function __request($method, $url, array $data = array())
    {
        $result = new RequestResult();
        $result_data = [];


        $full_url = $this->api_url.$url;
        $result->setUrl($full_url);

        #в запросе указывать Content type равным “application/json”,
        #​ таймаут ожидания выполнения запроса 60 секунд,

        $options = [
            #'form_params' => $data,
            #'body' => $data,
        ];

        $client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type' => 'application/json'
            ];

        $params = [
            'headers' => $headers,
            'timeout' => 60,
            'http_errors' => false,
            ];

        if($this->session_id)
            $data["SessionId"]= $this->session_id;

        if($method == self::METHOD_POST)
        {
            $params['json'] = $data;
        }
        elseif($method == self::METHOD_GET)
        {
            $d = array();

            foreach($data as $key => $val)
                $d[] = $key.'='.urlencode($val);

            $full_url .= $d ? '?'.http_build_query($d) : '';
        }

        $res = $client->request($method, $full_url, $params);

        if((int)$res->getStatusCode() >= 200 && (int)$res->getStatusCode() <= 226)
        {
            try{
                $result_data = (array)json_decode($res->getBody(), true);

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
            $result->setError($res->getStatusCode(), 'Err: '.$res->getBody());
        }

        if(isset($result_data['ErrorCode']) && $result_data['ErrorCode'] !== 0)
        {
            $error = isset($result_data['Error']) ? $result_data['Error'] : null;
            $result->setError($result_data['ErrorCode'], $error);
        }
        else
        {
            $result->setData($result_data);
        }

        return $result;
    }
}