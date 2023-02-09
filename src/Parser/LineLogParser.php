<?php

namespace Hl\LogReaderBundle\Parser;

use Hl\LogReaderBundle\Model\Logfile;
use Hl\LogReaderBundle\Parser\LogParserInterface;

class LineLogParser implements LogParserInterface
{
    protected array $pattern = [
        'default' => '/\[(?P<date>.*)\] (?P<channel>\w+).(?P<level>\w+): (?P<message>[^\[\{].*[\]\}])/',
    ];

    public function parse(string $line, LogFile $logfile, string $pattern = 'default')
    {
        preg_match($this->pattern[$pattern], $line, $data);

        if (!isset($data['date'])) {
            return [];
        }

        return [
            'date' => new \DateTime($data['date']),
            'channel' => $data['channel'],
            'level' => $data['level'],
            'message' => $data['message'],
        ];
    }

    public function registerPattern(string $name, string $pattern)
    {
        if (!isset($this->pattern[$name])) {
            $this->pattern[$name] = $pattern;
        } else {
            throw new \RuntimeException("Pattern $name already exists");
        }
    }
}
