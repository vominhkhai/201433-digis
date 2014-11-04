<?php

namespace MK\CommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MKCommonBundle extends Bundle
{
     private static $containerInstance = null;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        parent::setContainer($container);
        self::$containerInstance = $container;
    }

    /**
     * @return type
     */
    public static function getContainer()
    {
        return self::$containerInstance;
    }
}
