<?php

declare(strict_types=1);

namespace App\Service;

use Exception;
use InvalidArgumentException;
use RuntimeException;

class TokenGeneratorService
{
    public const CHAR_LOWER = 1;
    public const CHAR_UPPER = 2;
    public const CHAR_NUMERIC = 4;
    public const CHAR_SPECIAL = 8;

    /**
     * Generate arbitrary length string consisted of
     * only lowercase, uppercase characters and numbers.
     *
     * @param int $length
     *
     * @throws Exception
     *
     * @return string
     */
    public function getToken(int $length): string
    {
        return $this->getCustomToken($length, self::CHAR_LOWER | self::CHAR_UPPER | self::CHAR_NUMERIC);
    }

    /**
     * Generate string consisted of only hexadecimal characters [0-9a-f].
     *
     * @param int $length
     *
     * @throws Exception
     *
     * @return string
     */
    public function getHexadecimalToken(int $length = 10): string
    {
        if ($length > 64 || $length < 1) {
            throw new InvalidArgumentException('Length must be an integer between 1 and 64');
        }

        return substr(bin2hex(random_bytes((int) ceil($length / 2))), 0, $length);
    }

    /**
     * Generate password consisted of minimum one of each characters: lowercase, uppercase and number.
     *
     * @param int $length
     *
     * @throws Exception
     *
     * @return string
     */
    public function getPassword(int $length): string
    {
        return $this->getCustomPassword($length, 1, 1, 1, 0);
    }

    /**
     * @throws Exception
     */
    public function getCustomPassword(int $length, int $lower, int $upper, int $numeric, int $special): string
    {
        if ($length < $lower + $upper + $numeric + $special) {
            throw new RuntimeException('Length can not be less then sum of characters');
        }

        $characters = '';
        $flags = 0;
        if ($lower) {
            $characters .= $this->getCustomToken($lower, self::CHAR_LOWER);
            $flags += self::CHAR_LOWER;
        }
        if ($upper) {
            $characters .= $this->getCustomToken($upper, self::CHAR_UPPER);
            $flags += self::CHAR_UPPER;
        }
        if ($numeric) {
            $characters .= $this->getCustomToken($numeric, self::CHAR_NUMERIC);
            $flags += self::CHAR_NUMERIC;
        }
        if ($special) {
            $characters .= $this->getCustomToken($special, self::CHAR_SPECIAL);
            $flags += self::CHAR_SPECIAL;
        }

        if ($length - \strlen($characters)) {
            if (!$flags) {
                $flags = self::CHAR_LOWER | self::CHAR_UPPER | self::CHAR_NUMERIC | self::CHAR_SPECIAL;
            }
            $characters .= $this->getCustomToken($length - \strlen($characters), $flags);
        }

        return str_shuffle($characters);
    }

    /**
     * @param int $length
     * @param $flags
     *
     * @throws Exception
     *
     * @return string
     */
    private function getCustomToken(int $length, $flags): string
    {
        $token = '';
        $characters = $this->getCharacters($flags);
        for ($i = 0; $i < $length; ++$i) {
            $token .= $characters[random_int(0, \strlen($characters) - 1)];
        }

        return $token;
    }

    private function getCharacters($flags): string
    {
        $characters = '';
        if ($flags & self::CHAR_LOWER) {
            $characters .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($flags & self::CHAR_UPPER) {
            $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($flags & self::CHAR_NUMERIC) {
            $characters .= '0123456789';
        }
        if ($flags & self::CHAR_SPECIAL) {
            $characters .= '+-_=!#$%&?@~';
        }

        return $characters;
    }
}
