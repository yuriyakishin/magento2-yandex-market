<?php

namespace Yu\YandexMarket\Model;

class Category extends \Magento\Framework\Model\AbstractModel implements \Yu\YandexMarket\Api\Data\CategoryInterface
{

    /**
     * Returns category id
     *
     * @return int|null
     */
    public function getCategoryId()
    {
        return $this->getData(self::KEY_CATEGORY_ID);
    }

    /**
     * Get parent category identifier
     *
     * @return int
     */
    public function getParentId()
    {
        $parentId = $this->getData(self::KEY_PARENT_ID);
        if (isset($parentId)) {
            return $parentId;
        }
        $parentIds = $this->getParentIds();
        return (int) array_pop($parentIds);
    }
    
    /** 
     * @return int
     */
    public function getLevel()
    {
        return $this->_getData(self::KEY_LEVEL);
    }

    /**
     * Retrieve Name data wrapper
     *
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::KEY_NAME);
    }

    /**
     * Set category ID
     *
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::KEY_CATEGORY_ID, $categoryId);
    }

    /**
     * Set parent category ID
     *
     * @param int $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        return $this->setData(self::KEY_PARENT_ID, $parentId);
    }
    
    /**
     * Set level
     *
     * @param int $level
     * @return $this
     */
    public function setLevel($level)
    {
        return $this->setData(self::KEY_LEVEL, $level);
    }

    /**
     * Set category name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::KEY_NAME, $name);
    }

}
