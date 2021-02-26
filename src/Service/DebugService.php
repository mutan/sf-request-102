<?php

declare(strict_types=1);

namespace App\Service;

use Exception;
use RuntimeException;

class DebugService
{
    private $debugLogFile;

    /**
     * @param $debugLogDirName
     * @param $debugLogFileName
     *
     * @throws Exception
     */
    public function __construct($debugLogDirName, $debugLogFileName)
    {
        $this->debugLogFile = $debugLogDirName.\DIRECTORY_SEPARATOR.$debugLogFileName;

        if (!file_exists($this->debugLogFile) && !touch($this->debugLogFile)) {
            throw new RuntimeException('Cannot make file: '.$this->debugLogFile);
        }
    }

    /**
     * @param mixed $payload
     * @param bool $isAppend
     *
     * @return bool|int
     */
    public function write($payload, bool $isAppend = false)
    {
        return $this->writeToFile($payload, $isAppend, false);
    }

    /**
     * @param mixed $payload
     * @param bool $isAppend
     *
     * @return bool|int
     */
    public function writeln($payload, bool $isAppend = false)
    {
        return $this->writeToFile($payload, $isAppend, true);
    }

    private function writeToFile($payload, bool $isAppend, bool $isNewline)
    {
        $eol = $isNewline ? \PHP_EOL : '';
        $flag = $isAppend ? \FILE_APPEND : 0;

        return file_put_contents($this->debugLogFile, print_r($payload, true).$eol, $flag);
    }
}
