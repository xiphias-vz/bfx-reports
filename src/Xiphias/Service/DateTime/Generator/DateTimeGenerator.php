<?php


declare(strict_types=1);

namespace Xiphias\Service\DateTime\Generator;

class DateTimeGenerator implements DateTimeGeneratorInterface
{
    /**
     * @param string $dateFormat
     *
     * @return string
     */
    public function generateCurrentDate(string $dateFormat): string
    {
        $currentDate = date($dateFormat);

        return $currentDate;
    }
}
