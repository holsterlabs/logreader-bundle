<?php

namespace Hl\LogReaderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Hl\LogReaderBundle\DependencyInjection\LogReaderExtension;

/**
 * LogReaderBundle
 * v1.0.2
 */
class LogReaderBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new LogReaderExtension();
    }
}
