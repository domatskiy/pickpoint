<?php
namespace Domatskiy\Tests;

use Domatskiy\PickPoint;
use Domatskiy\PickPoint\Type;

class SendingsTest extends \PHPUnit_Framework_TestCase
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
        $CPicPoint = new PickPoint($this->config_is_test);
        $CPicPoint->login($this->config_login, $this->config_passw);

        $rsLogin = $CPicPoint->login();
        $this->assertEquals($rsLogin instanceof Type\Auth, true);

        $rsCityList = $CPicPoint->directory()->citylist();
        $this->assertEquals($rsCityList instanceof Type\CityList, true);
        $city = current($rsCityList->data);
        print_r($city->Id);

        $rsPostomat = $CPicPoint->directory()->postamatlist();
        $this->assertEquals($rsPostomat instanceof Type\PostomatList, true);
        $postomat = current($rsPostomat->data);
        print_r($postomat->Id.' '.$postomat->PostCode);


        $sendings = $CPicPoint->sendings();
        $this->assertEquals($sendings instanceof PickPoint\Sendings, true);

        $invoice = new PickPoint\Invoice(
            '1111',
            'заказ новый',
            'sdsdssdds',
            $postomat->Id,
            '+79172222222',
            'test@test.ru',
            PickPoint\Invoice::POSTAGE_TYPE_STANDART_NP,
            PickPoint\Invoice::GETTING_TYPE_SC,
            PickPoint\Invoice::PAY_TYPE,
            1000,
            0,
            new PickPoint\Invoice\ClientReturnAddress('Казнь', 'Татарстан', 'sds','fio', '420066', 'ООО Kpita', '+791544545', 'коммент'),
            new PickPoint\Invoice\UnclaimedReturnAddress('Казнь', 'Татарстан', 'sds','fio', '420066', 'ООО Kpita', '+791544545', 'коммент'),
            array()
            );

        $sending = new PickPoint\Sendings\Sending('544646455', '5464654', $invoice);

        $rsCreadeSendingSingle = $sendings->createsending([$sending]);

        if($rsCreadeSendingSingle->isSuccess())
            print_r($rsCreadeSendingSingle->getData());
        else
            print_r($rsCreadeSendingSingle->getErrors());

        $this->assertEquals($rsCreadeSendingSingle->isSuccess(), true);


    }

}
