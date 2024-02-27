<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Zed\Acl\Business\Model;

use BladeFx\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface;
use Generated\Shared\Transfer\RoleTransfer;
use Spryker\Zed\Acl\Business\Exception\RoleNotFoundException;
use Spryker\Zed\Acl\Business\Model\GroupInterface;
use Spryker\Zed\Acl\Business\Model\Role as SprykerRole;
use Spryker\Zed\Acl\Persistence\AclQueryContainerInterface;

class Role extends SprykerRole
{
    /**
     * @var \BladeFx\Zed\Acl\Persistence\AclQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \BladeFx\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface
     */
    protected  BladeFxRoleWriterInterface $bfxRoleWriter;

    /**
     * @param \Spryker\Zed\Acl\Business\Model\GroupInterface $group
     * @param \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface $queryContainer
     * @param array $aclRolesExpanderPlugins
     * @param array $aclRolePostSavePlugins
     * @param \BladeFx\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface $bfxRoleWriter
     */
    public function __construct(
        GroupInterface $group,
        AclQueryContainerInterface $queryContainer,
        array $aclRolesExpanderPlugins,
        array $aclRolePostSavePlugins,
        BladeFxRoleWriterInterface $bfxRoleWriter,
    ) {
        parent::__construct($group, $queryContainer, $aclRolesExpanderPlugins, $aclRolePostSavePlugins);
        $this->bfxRoleWriter = $bfxRoleWriter;
    }

    /**
     * @param int $idRole
     *
     * @throws \Spryker\Zed\Acl\Business\Exception\RoleNotFoundException
     *
     * @return bool
     */
    public function removeRoleById($idRole): bool
    {
        $aclRules = $this->queryContainer->queryRuleByRoleId($idRole)->find();
        $aclRules->delete();

        $aclRoleEntity = $this->queryContainer->queryRoleByIdForDelete($idRole)->delete();

        if ($aclRoleEntity <= 0) {
            throw new RoleNotFoundException();
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\RoleTransfer $roleTransfer
     *
     * @return \Generated\Shared\Transfer\RoleTransfer
     */
    public function save(RoleTransfer $roleTransfer): RoleTransfer
    {
        $savedRoleTransfer = parent::save($roleTransfer);

        $this->bfxRoleWriter->writeBladeFxRole($roleTransfer);

        return $savedRoleTransfer;
    }
}
