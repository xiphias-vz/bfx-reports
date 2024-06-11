<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
