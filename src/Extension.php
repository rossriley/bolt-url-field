<?php

namespace Bolt\Extension\Ross\URLField;

use Bolt\Extension\Ross\URLField\Provider\FieldProvider;
use Bolt\Extension\SimpleExtension;

/**
 * The main extension class.
 *
 * @author Ross Riley <riley.ross@gmail.com>
 */
class Extension extends SimpleExtension
{

    public function getServiceProviders()
    {
        return [
            $this,
            new FieldProvider()
        ];
    }

    protected function registerTwigPaths()
    {
        return [
            'templates' => ['position' => 'prepend', 'namespace' => 'bolt']
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function registerAssets()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    protected function registerTwigFunctions()
    {
        return [];
    }

}
