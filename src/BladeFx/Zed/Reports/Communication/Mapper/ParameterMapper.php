<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Communication\Mapper;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Symfony\Component\HttpFoundation\Request;

class ParameterMapper
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer
    {
        return (new BladeFxParameterTransfer())
            ->setParamName($request->query->get('paramName'))
            ->setParamValue($request->query->get('paramValue'))
            ->setSqlDbType('');
    }
}