<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Filesystem;

/**
 * Class WrapperFactory
 *
 * @package Magento\Filesystem
 */
class WrapperFactory
{
    /**
     * @var array
     */
    private $wrappers = array();

    /**
     * @var \Magento\Filesystem\DirectoryList
     */
    protected $directoryList;

    /**
     * @param DirectoryList $directoryList
     */
    public function __construct(DirectoryList $directoryList)
    {
        $this->directoryList = $directoryList;
    }

    /**
     * Return specific wrapper
     *
     * @param string $protocolCode
     * @param DriverInterface $driver
     * @return WrapperInterface
     */
    public function get($protocolCode, DriverInterface $driver)
    {
        $wrapperClass = $this->directoryList->getProtocolConfig($protocolCode)['driver'];

        if (!isset($this->wrappers[$protocolCode])) {
            $this->wrappers[$protocolCode] = new $wrapperClass($driver);
        }

        return $this->wrappers[$protocolCode];
    }
}
