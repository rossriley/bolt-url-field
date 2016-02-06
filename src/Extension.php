<?php

namespace Bolt\Extension\Ross\URLField;

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
