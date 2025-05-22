<?php


declare(strict_types=1);

namespace Xiphias\Service\DateTime;

interface DateTimeServiceInterface
{
    /**
     * @param string $dateFormat
     *
     * @return string
     */
    public function getCurrentDate(string $dateFormat): string;
}
