<?php

namespace Alevel\MyModule\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Alevel\MyModule\Model\ResourceModel\Post
 */
class Collection extends AbstractCollection
{
    /**
     * Define model and resource model.
     */
    protected function _construct()
    {
        $this->_init(
            \Alevel\MyModule\Model\Post::class,
            \Alevel\MyModule\Model\ResourceModel\Post::class
        );
    }
}