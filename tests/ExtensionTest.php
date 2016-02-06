<?php

namespace Bolt\Extension\Ross\URLField\Tests;

use Bolt\Tests\BoltUnitTest;
use Bolt\Extension\Ross\URLField\Extension;

/**
 * ExtensionName testing class.
 *
 * @author Your Name <you@example.com>
 */
class ExtensionTest extends BoltUnitTest
{
    /**
     * Ensure that the ExtensionName extension loads correctly.
     */
    public function testExtensionRegister()
    {
        $app = $this->getApp(false);
        $extension = new Extension($app);
        $app['extensions']->add($extension);

        $name = $extension->getName();
        $this->assertSame($name, 'ExtensionName');
        $this->assertInstanceOf('\Bolt\Extension\ExtensionInterface', $app['extensions']->get('ExtensionName'));
    }
}
