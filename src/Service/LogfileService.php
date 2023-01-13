<?php

namespace Hl\LogReaderBundle\Service;

use Hl\LogReaderBundle\Model\Logfile as ModelLogfile;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LogfileService
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getLogfileList(): array
    {
        $logfiles = [];
        $id = 0;

        $finder = new Finder();
        $finder->files()->in($this->parameterBag->get('kernel.logs_dir'));

        foreach ($finder as $file) {
            $logfile = new ModelLogfile;
            $logfile
                ->setId($id)
                ->setName($file->getFilename())
                ->setPath($file->getRealPath())
                ->setSize($file->getSize())
                ->setMTime($file->getMTime());

            $logfiles[$id] = $logfile;
            $id++;
        }

        return $logfiles;
    }
}
