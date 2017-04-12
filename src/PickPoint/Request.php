<?php

namespace Domatskiy\PickPoint;


use Domatskiy\PickPoint\Exception\ErrorException;
use Domatskiy\PickPoint\Exception\ForbiddenException;
use Domatskiy\PickPoint\Exception\JsonException;
use Domatskiy\PickPoint\Exception\NotFoundException;
use Domatskiy\PickPoint\Type\Result;

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
    protected $IKN_test = '9990003041';

    /**
     * Request constructor.
     * @param $session_id
     * @param $is_test
     */
    function __construct($session_id = null, $is_test = false)
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
     * @return Result
     */
    protected function __request($method, $url, $object, array $data = array())
    {
        $full_url = $this->api_url.$url;

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
            $content_type = $res->getHeader('Content-Type');

            if(is_array($content_type))
                $content_type = current($content_type);

            if(strpos($content_type, 'application/json') !== false)
            {
                try{
                    $data = (array)json_decode($res->getBody(), true);
                }
                catch (\Exception $e)
                {
                    throw new JsonException($e->getMessage(), $e->getCode());
                }

                if(isset($data['ErrorCode']) && $data['ErrorCode'] !== 0)
                {
                    $message = isset($data['ErrorMessage']) ? $data['ErrorMessage'] : '';
                    throw new \ErrorException($message, $data['ErrorCode']);
                }

                return new $object($data);

            }
            else
            {
                if(strpos($res->getBody(), 'Error'))
                    throw new ErrorException($res->getBody());

                return new $object($data);
            }

        }
        elseif ($res->getStatusCode() == 403)
            throw new ForbiddenException($url);
        elseif ($res->getStatusCode() == 404)
            throw new NotFoundException($url);
        else
        {
            new \Exception('what is it?');
        }

    }
}