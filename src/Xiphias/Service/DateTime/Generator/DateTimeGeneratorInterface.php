<?php


declare(strict_types=1);

namespace Xiphias\Service\DateTime\Generator;

interface DateTimeGeneratorInterface
{
    /**
     * @param string $dateFormat
     *
     * @return string
     */
    public function generateCurrentDate(string $dateFormat): string;
}
