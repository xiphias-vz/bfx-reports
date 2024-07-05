<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Service\DateTime;

use Spryker\Service\Kernel\AbstractServiceFactory;
use Xiphias\Service\DateTime\Generator\DateTimeGenerator;
use Xiphias\Service\DateTime\Generator\DateTimeGeneratorInterface;

class DateTimeServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \Xiphias\Service\DateTime\Generator\DateTimeGeneratorInterface
     */
    public function createDateTimeGenerator(): DateTimeGeneratorInterface
    {
        return new DateTimeGenerator();
    }
}
