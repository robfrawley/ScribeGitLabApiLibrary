<?php

namespace Gitlab\Tests\Api;

class MetaTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetInformationService()
    {
        $expectedArray = array(
            'hooks' => array(
                '127.0.0.1/32'
            ),
            'git' => array(
                '127.0.0.1/32'
            ),
            'verifiable_password_authentication' => true
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->service());
    }

    protected function getApiClass()
    {
        return 'Gitlab\Api\Meta';
    }
}
