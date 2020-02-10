<?php

namespace Alevel\MyModule\Api\Data;

/**
 * Interface PostInterface
 * @package Alevel\MyModule\Api\Data
 */
interface PostInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const CONTENT = 'content';
    const ENABLED = 'enabled';
    const TELEPHONE = 'telephone';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getEnabled();

    /**
     * @return mixed
     */
    public function getTelephone();
}
