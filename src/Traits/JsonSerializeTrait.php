<?php

declare(strict_types=1);

namespace App\Traits;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use ReflectionClass;
use stdClass;

trait JsonSerializeTrait
{
    /**
     * @return array|StdClass
     */
    public function jsonSerialize()
    {
        $reflection = new ReflectionClass($this);

        $result = [];
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();

            $property->setAccessible(true);

            //condition for php7.4
            if (method_exists($property, 'isInitialized') && !$property->isInitialized($this)) {
                continue;
            }

            $value = $property->getValue($this);

            if (null === $value) {
                continue;
            }

            if ($value instanceof DateTimeInterface) {
                $value = $value->format(DateTimeInterface::RFC3339);
            }

            if ($value instanceof Collection) {
                $value = $value->toArray();
            }

            $result[$name] = $value;
        }

        return $result ?: new StdClass();
    }
}
