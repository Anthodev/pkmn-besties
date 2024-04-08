<?php

namespace App\Tests\Domain\Home\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetHomeTest extends WebTestCase
{
    public function testInvokeGetHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
