<?php

namespace Domatskiy;

use Domatskiy\PickPoint\Request;
use Domatskiy\PickPoint\Type;

class PickPoint extends Request
{
    /**
     * @param string $login
     * @param string $passw
     * @return Type\Auth
     */
    public function login($login = '', $passw = '')
    {
        if($this->is_test)
        {
            $login = 'apitest';
            $passw = 'apitest';
        }

        /**
         * @var $Auth Type\Auth
         */
        $Auth = $this->__request(self::METHOD_POST, '/login', Type\Auth::class, [
            'login' => $login,
            'password' => $passw
            ]);

        if($Auth->SessionId && !$this->is_test)
            $this->session_id = $Auth->SessionId;

        return $Auth;
    }

    /**
     * @return Type\Result
     */
    public function logout()
    {
        /**
         * @var $Result Type\Result
         */
        $Result = $this->__request(self::METHOD_POST, '/logout', Type\Result::class);

        return $Result;
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