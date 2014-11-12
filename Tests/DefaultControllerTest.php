<?php

namespace Kilix\AppStatusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;

class DefaultControllerTest extends WebTestCase
{
    public function testGetAllStatus()
    {
        $client = $this->createClient();
        $router = self::$kernel->getContainer()->get('router');
        $route = $router->generate('kilix_app_status_page');

        $client->request('GET', $route);
        $response = $client->getResponse();
        $content = json_decode($response->getContent(),true);

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('OK', $content['test_passing']);
        $this->assertEquals('KO', $content['test_failing']);
    }

    public function testGetNotFoundStatus()
    {
        $client = $this->createClient();
        $router = self::$kernel->getContainer()->get('router');
        $route = $router->generate('kilix_app_status_page');

        $client->request('GET', $route.'/notFound');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetPassingStatus()
    {
        $client = $this->createClient();
        $router = self::$kernel->getContainer()->get('router');
        $route = $router->generate('kilix_app_status_page');

        $client->request('GET', $route.'/test_passing');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(),true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $content['test_passing']);
    }

    public function testGetFailingStatus()
    {
        $client = $this->createClient();
        $router = self::$kernel->getContainer()->get('router');
        $route = $router->generate('kilix_app_status_page');

        $client->request('GET', $route.'/test_failing');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(),true);

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('KO', $content['test_failing']);
    }

    protected function setUp()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/KilixAppStatusBundleTestsTestBundle/');
    }

    protected static function createKernel(array $options = array())
    {
        return self::$kernel = new AppKernel(
            isset($options['config']) ? $options['config'] : 'default.yml'
        );
    }

}