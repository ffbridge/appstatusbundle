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

        $client->request('GET', $route.'/test_db');
        $response = $client->getResponse();
        $content = json_decode($response->getContent(),true);

        $this->assertEquals(200, $response->getStatusCode());
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