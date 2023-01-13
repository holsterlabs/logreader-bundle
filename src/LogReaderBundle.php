<?php

namespace Hl\LogReaderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Hl\LogReaderBundle\DependencyInjection\HLogReaderExtension;

/**
 * LogReaderBundle
 * v1
 */
class LogReaderBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new HlLogReaderExtension();
    }
}
