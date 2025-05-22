<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\TokenResolver;

interface TokenResolverInterface
{
    /**
     * @return string|null
     */
    public function resolveToken(): string|null;
}
