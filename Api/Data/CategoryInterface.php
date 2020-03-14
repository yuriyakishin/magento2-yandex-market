<?php

namespace Yu\YandexMarket\Api\Data;

interface CategoryInterface
{

    const KEY_CATEGORY_ID = 'category_id';
    const KEY_PARENT_ID = 'parent_id';
    const KEY_NAME = 'name';
    const KEY_LEVEL = 'level';

    /**
     * Retrieve category id.
     *
     * @return int|null
     */
    public function getCategoryId();

    /**
     * Set category id.
     *
     * @param int $id
     * @return $this
     */
    public function setCategoryId($id);

    /**
     * Get parent category ID
     *
     * @return int|null
     */
    public function getParentId();

    /**
     * Set parent category ID
     *
     * @param int $parentId
     * @return $this
     */
    public function setParentId($parentId);
    
    /**
     * Get category level
     *
     * @return int|null
     */
    public function getLevel();

    /**
     * Set category level
     *
     * @param int $level
     * @return $this
     */
    public function setLevel($level);

    /**
     * Get category name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set category name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);
}
