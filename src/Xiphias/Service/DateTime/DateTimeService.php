<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Service\DateTime;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \Xiphias\Service\DateTime\DateTimeServiceFactory getFactory()
 */
class DateTimeService extends AbstractService implements DateTimeServiceInterface
{
    /**
     * @param string $dateFormat
     *
     * @return string
     */
    public function getCurrentDate(string $dateFormat): string
    {
        return $this->getFactory()
            ->createDateTimeGenerator()
            ->generateCurrentDate($dateFormat);
    }
}
