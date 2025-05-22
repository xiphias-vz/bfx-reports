<?php


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
