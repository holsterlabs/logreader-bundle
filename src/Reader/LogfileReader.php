<?php

namespace Hl\LogReaderBundle\Reader;

use Hl\LogReaderBundle\Parser\LineLogParser;
use Hl\LogReaderBundle\Parser\LogParserInterface;
use Hl\LogReaderBundle\Model\Logfile;

class LogfileReader implements \Iterator, \ArrayAccess, \Countable
{
    private $logfile;
    private $file;
    private $lineCount;
    private $parser;
    private $pattern;

    public function __construct(Logfile $logfile, $pattern = 'default')
    {
        $this->logfile = $logfile;
        $this->pattern = $pattern;
        $this->file = new \SplFileObject($logfile->getPath(), 'r');

        $i = 0;
        while (!$this->file->eof()) {
            $this->file->current();
            $this->file->next();
            $i++;
        }
        $this->lineCount = $i;
        $this->parser = new LineLogParser;
    }

    public function current(): mixed
    {
        return $this->parser->parse($this->file->current(), $this->logfile, $this->pattern);
    }

    public function next(): void
    {
        $this->file->next();
    }

    public function key(): int
    {
        return $this->file->key();
    }

    public function valid(): bool
    {
        return $this->file->valid();
    }

    public function rewind(): void
    {
        $this->file->rewind();
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->lineCount < $offset;
    }

    public function offsetGet(mixed $offset): mixed
    {
        $key = $this->file->key();
        $this->file->seek($offset);
        $log = $this->current();
        $this->file->seek($key);
        $this->file->current();

        return $log;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \RuntimeException("LogReader is read-only.");
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \RuntimeException("LogReader is read-only.");
    }

    public function count(): int
    {
        return $this->lineCount;
    }

    public function getParser(): LogParserInterface
    {
        $parser = &$this->parser;
        return $parser;
    }

    public function setPattern(string $pattern = 'default')
    {
        $this->pattern = $pattern;
    }
}
