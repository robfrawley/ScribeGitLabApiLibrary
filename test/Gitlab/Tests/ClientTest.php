<?php

namespace Gitlab\Tests;

use Gitlab\Client;
use Gitlab\Exception\InvalidArgumentException;
use Gitlab\Exception\BadMethodCallException;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldNotHaveToPassHttpClientToConstructor()
    {
        $client = new Client();

        $this->assertInstanceOf('Gitlab\HttpClient\HttpClient', $client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldPassHttpClientInterfaceToConstructor()
    {
        $client = new Client($this->getHttpClientMock());

        $this->assertInstanceOf('Gitlab\HttpClient\HttpClientInterface', $client->getHttpClient());
    }

    /**
     * @test
     * @dataProvider getAuthenticationFullData
     */
    public function shouldAuthenticateUsingAllGivenParameters($login, $password, $method)
    {
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())
            ->method('authenticate')
            ->with($login, $password, $method);

        $client = new Client($httpClient);
        $client->authenticate($login, $password, $method);
    }

    public function getAuthenticationFullData()
    {
        return array(
            array('login', 'password', Client::AUTH_HTTP_PASSWORD),
            array('token', null, Client::AUTH_HTTP_TOKEN),
            array('token', null, Client::AUTH_URL_TOKEN),
            array('client_id', 'client_secret', Client::AUTH_URL_CLIENT_ID),
        );
    }

    /**
     * @test
     * @dataProvider getAuthenticationPartialData
     */
    public function shouldAuthenticateUsingGivenParameters($token, $method)
    {
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())
            ->method('authenticate')
            ->with($token, null, $method);

        $client = new Client($httpClient);
        $client->authenticate($token, $method);
    }

    public function getAuthenticationPartialData()
    {
        return array(
            array('token', Client::AUTH_HTTP_TOKEN),
            array('token', Client::AUTH_URL_TOKEN),
        );
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function shouldThrowExceptionWhenAuthenticatingWithoutMethodSet()
    {
        $httpClient = $this->getHttpClientMock(array('addListener'));

        $client = new Client($httpClient);
        $client->authenticate('login', null, null);
    }

    /**
     * @test
     */
    public function shouldClearHeadersLazy()
    {
        $httpClient = $this->getHttpClientMock(array('clearHeaders'));
        $httpClient->expects($this->once())->method('clearHeaders');

        $client = new Client($httpClient);
        $client->clearHeaders();
    }

    /**
     * @test
     */
    public function shouldSetHeadersLaizly()
    {
        $headers = array('header1', 'header2');

        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())->method('setHeaders')->with($headers);

        $client = new Client($httpClient);
        $client->setHeaders($headers);
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->api($apiName));
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetMagicApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->$apiName());
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function shouldNotGetApiInstance()
    {
        $client = new Client();
        $client->api('do_not_exist');
    }

    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldNotGetMagicApiInstance()
    {
        $client = new Client();
        $client->doNotExist();
    }

    public function getApiClassesProvider()
    {
        return array(
            array('user', 'Gitlab\Api\User'),
            array('users', 'Gitlab\Api\User'),

            array('me', 'Gitlab\Api\CurrentUser'),
            array('current_user', 'Gitlab\Api\CurrentUser'),
            array('currentUser', 'Gitlab\Api\CurrentUser'),

            array('git', 'Gitlab\Api\GitData'),
            array('git_data', 'Gitlab\Api\GitData'),
            array('gitData', 'Gitlab\Api\GitData'),

            array('gist', 'Gitlab\Api\Gists'),
            array('gists', 'Gitlab\Api\Gists'),

            array('issue', 'Gitlab\Api\Issue'),
            array('issues', 'Gitlab\Api\Issue'),

            array('markdown', 'Gitlab\Api\Markdown'),

            array('organization', 'Gitlab\Api\Organization'),
            array('organizations', 'Gitlab\Api\Organization'),

            array('repo', 'Gitlab\Api\Repo'),
            array('repos', 'Gitlab\Api\Repo'),
            array('repository', 'Gitlab\Api\Repo'),
            array('repositories', 'Gitlab\Api\Repo'),

            array('pr', 'Gitlab\Api\PullRequest'),
            array('pullRequest', 'Gitlab\Api\PullRequest'),
            array('pull_request', 'Gitlab\Api\PullRequest'),
            array('pullRequests', 'Gitlab\Api\PullRequest'),
            array('pull_requests', 'Gitlab\Api\PullRequest'),

            array('authorization', 'Gitlab\Api\Authorizations'),
            array('authorizations', 'Gitlab\Api\Authorizations'),

            array('meta', 'Gitlab\Api\Meta')
        );
    }

    public function getHttpClientMock(array $methods = array())
    {
        $methods = array_merge(
            array('get', 'post', 'patch', 'put', 'delete', 'request', 'setOption', 'setHeaders', 'authenticate'),
            $methods
        );

        return $this->getMock('Gitlab\HttpClient\HttpClientInterface', $methods);
    }
}
