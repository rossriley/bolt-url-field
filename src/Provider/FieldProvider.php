<?php

namespace Bolt\Extension\Ross\URLField;

use Bolt\Extension\Ross\URLField\Field\URLFieldType;
use Bolt\Storage\FieldManager;
use Silex\Application;
use Silex\ServiceProviderInterface;

class FieldProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['storage.field_manager'] = $app->share(
            $app->extend(
                'storage.field_manager',
                function (FieldManager $manager) {
                    $manager->addFieldType('url', new URLFieldType());

                    return $manager;
                }
            )
        );

    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}
