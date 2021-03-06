<?php

namespace Alevel\MyModule\Model;

use Magento\Framework\Model\AbstractModel;
use Alevel\MyModule\Api\Data\PostInterface;

use Alevel\MyModule\Model\ResourceModel\Post as ResourceModel;

/**
 * Class Post.
 *
 * @package Alevel\MyModule\Model
 */
class Post extends AbstractModel implements PostInterface
{

    /**
     *  Init resource model.
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->getData(PostInterface::NAME);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getData(PostInterface::EMAIL);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->getData(PostInterface::CONTENT);
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->getData(PostInterface::ENABLED);
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->getData(PostInterface::TELEPHONE);
    }

    public function getIndNum()
    {
        return $this->getData(PostInterface::INDNUM);
    }

}