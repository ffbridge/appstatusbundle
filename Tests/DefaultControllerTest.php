<?php

namespace Kilix\AppStatusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = $this->createClient();
        $router = self::$kernel->getContainer()->get('router');
        $route = $router->generate('kilix_app_status_page');

        $client->request('GET', $route);
        $response = $client->getResponse();
        $content = json_decode($response->getContent(),true);
        
        print_r($content);

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function setUp()
    {
        $fs = new Filesystem();
        //$fs->remove(sys_get_temp_dir().'/LilaConceptsBestPracticeBundle/');
    }

    protected static function createKernel(array $options = array())
    {
        return self::$kernel = new AppKernel(
            isset($options['config']) ? $options['config'] : 'default.yml'
        );
    }

}
