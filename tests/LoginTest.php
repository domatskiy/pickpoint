<?php
namespace Domatskiy\Tests;

use Domatskiy\PickPoint;
use Domatskiy\PickPoint\RequestResult;
use Domatskiy\Session\Login;

class LoginTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }

    public function test()
    {
        $CPicPoint = new PickPoint('', '', true);

        $result = $CPicPoint->login();

        $this->assertEquals($result instanceof RequestResult, true);

        if($result->isSuccess())
            var_dump($result->getData());
        else
            var_dump($result->getErrors());

    }

}
