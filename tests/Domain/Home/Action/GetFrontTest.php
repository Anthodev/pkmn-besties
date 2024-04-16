<?php

declare(strict_types=1);

namespace App\Tests\Domain\Home\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetFrontTest extends WebTestCase
{
    public function testInvokeGetHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
