<?php

namespace H_\LogReaderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use H_\LogReaderBundle\DependencyInjection\H_LogReaderExtension;

/**
 * SecurityHeadersBundle
 */
class LogReaderBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new H_LogReaderExtension();
    }
}
