<?php

declare(strict_types=1);

namespace Xiphias\Zed\XiphiasAcl\Communication\Console;

use PHPUnit\Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Xiphias\Zed\XiphiasAcl\Communication\XiphiasAclCommunicationFactory getFactory()
 */
class XiphiasAclInstallerConsole extends Console
{
    /**
     * @var string
     */
    protected const COMMAND_NAME = 'xiphias:acl:install';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription('Install groups and roles from Acl installer plugins');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->getFactory()->getAclFacade()->install();
        } catch (Exception) {
            return static::CODE_ERROR;
        }

        return static::CODE_SUCCESS;
    }
}
