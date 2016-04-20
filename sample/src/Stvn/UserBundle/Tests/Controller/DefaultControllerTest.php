<?php

namespace Stvn\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Steven
 * functional test for Default controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * test login action
     */
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertTrue($crawler->filter('html:contains("email")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("password")')->count() > 0);
    }
    /**
     * test sign action
     */
    public function testSign()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sign');

        $this->assertTrue($crawler->filter('html:contains("Email")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Password")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Confirmed password")')->count() > 0);
    }
}
