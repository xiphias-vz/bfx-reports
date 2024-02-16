<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Zed\Reports\Communication\DataProvider;

use ArrayObject;

interface ReportsTableDataProviderInterface
{
    /**
     * @return \ArrayObject
     */
    public function provideData(): ArrayObject;
}
