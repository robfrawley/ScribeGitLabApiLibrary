<?php
/**
 * This file is part of the PHP GitHub API package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitlab\Tests\Api;

class EnterpriseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetEntepriseStatsApiObject()
    {
        $api = $this->getApiMock();

        $this->assertInstanceOf('Gitlab\Api\Enterprise\Stats', $api->stats());
    }

    /**
     * @test
     */
    public function shouldGetEnterpriseLicenseApiObject()
    {
        $api = $this->getApiMock();

        $this->assertInstanceOf('Gitlab\Api\Enterprise\License', $api->license());
    }

    protected function getApiClass()
    {
        return 'Gitlab\Api\Enterprise';
    }
}

