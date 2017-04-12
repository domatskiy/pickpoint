<?php
namespace Domatskiy\Tests;

use Domatskiy\PickPoint;
use Domatskiy\PickPoint\RequestResult;

class DeliveryTest extends \PHPUnit_Framework_TestCase
{
    private $config_is_test = null,
            $config_login = null,
            $config_passw = null;

    public function setUp()
    {
        $reader = new \Piwik\Ini\IniReader();
        $config = $reader->readFile(__DIR__.'/config.ini');

        $this->config_is_test = isset($config['test']) && (int)$config['test'] == 1;
        $this->config_login = isset($config['login']) ? $config['login'] : '';
        $this->config_passw = isset($config['passw']) ? $config['passw'] : '';

        echo "\n";
        echo 'auth with login:'.$this->config_login.', passw:'.$this->config_passw.', $is_test='.$this->config_is_test;
        echo "\n";
    }

    public function tearDown()
    {

    }

    public function test()
    {
        $CPicPoint = new PickPoint($this->config_login, $this->config_passw, $this->config_is_test);

        $rsLogin = $CPicPoint->login();

        $this->assertEquals($rsLogin instanceof RequestResult, true);
        $this->assertEquals($rsLogin->isSuccess(), true);

        if($rsLogin->isSuccess())
        {
            $rsCity = $CPicPoint->directory()->citylist();
            $this->assertEquals($rsCity instanceof RequestResult, true);
            $this->assertEquals($rsCity->isSuccess(), true);
            $city = current($rsCity->getData());
            print_r($city);

            $rsPostomat = $CPicPoint->directory()->postamatlist();
            $this->assertEquals($rsPostomat instanceof RequestResult, true);
            $this->assertEquals($rsPostomat->isSuccess(), true);
            $postomat = current($rsPostomat->getData());
            print_r($postomat);

            $rsZone = $CPicPoint->delivery()->getzone($city['Id'], $postomat['Id']);
            $this->assertEquals($rsZone instanceof RequestResult, true);

            if($rsZone->isSuccess())
                print_r($rsZone->getData());
            else
                print_r($rsZone->getErrors());

            $this->assertEquals($rsZone->isSuccess(), true);
            $zone = current($rsZone->getData());




        }
    }

}
