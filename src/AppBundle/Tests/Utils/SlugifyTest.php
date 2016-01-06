<?php

namespace AppBundle\Tests\Utils;

use AppBundle\Utils\Slugify;

class SlugifyTest extends \PHPUnit_Framework_TestCase {

    public function testSlug()
    {
        $this->assertEquals(Slugify::slug("Ремонт: иммобилайзера, программирование; иммобилайзера."), "ремонт-иммобилайзера-программирование-иммобилайзера");
    }
} 