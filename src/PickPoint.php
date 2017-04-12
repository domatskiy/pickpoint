<?php

namespace Domatskiy;

use Domatskiy\PickPoint\Request;
use Domatskiy\PickPoint\RequestResult;

class PickPoint extends Request
{
    /**
     * @param string $login
     * @param string $passw
     * @return RequestResult
     */
    public function login($login = '', $passw = '')
    {
        if($this->is_test)
        {
            $login = 'apitest';
            $passw = 'apitest';
        }

        $result = $this->__request(self::METHOD_POST, '/login', [
            'login' => $login,
            'password' => $passw
            ]);

        $data = $result->getData();

        if(!isset($data['SessionId']) && !$this->is_test)
            $result->setError(null, $data['ErrorMessage']);
        else
            $this->session_id = $data['SessionId'];

        return $result;
    }

    /**
     * @return RequestResult
     */
    public function logout()
    {
        $result = $this->__request(self::METHOD_POST, '/logout');

        $data = $result->getData();

        if(!isset($data['Success']) || !$data['Success'])
            $result->setError(0, 'logout error');

        return $result;
    }

    /**
     * @return PickPoint\Sendings
     */
    public function sendings()
    {
        return new PickPoint\Sendings($this->session_id, $this->is_test);
    }

    /**
     * @return PickPoint\Directory
     */
    public function directory()
    {
        return new PickPoint\Directory($this->session_id, $this->is_test);
    }

    /**
     * @return PickPoint\Delivery
     */
    public function delivery()
    {
        return new PickPoint\Delivery($this->session_id, $this->is_test);
    }

}