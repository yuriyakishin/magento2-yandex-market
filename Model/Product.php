<?php

namespace Yu\YandexMarket\Model;

class Product extends \Magento\Framework\Model\AbstractModel implements \Yu\YandexMarket\Api\Data\ProductInterface
{
    /**
     *Дополнительные параметры для выгрузки в прайс
     * 
     * @var array 
     * $params = [
     *              'label' => '',
     *              'value' => ''
     *           ]
     */
    private $params = array();
    
    /**
     * Identifier getter
     *
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }
    
    /**
     * 
     * @return int
     */
    public function getCategoryId()
    {
        return $this->_getData(self::CATEGORY_ID);
    }


    /**
     * Get product name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }
    
    /**
     * Get product description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_getData(self::DESCRIPTION);
    }
    
    /**
     * Get product warranty
     *
     * @return string
     */
    public function getWarranty()
    {
        return $this->_getData(self::WARRANTY);
    }
    
    /**
     * Get product country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->_getData(self::COUNTRY);
    }
    
    /**
     * Retrieve sku through type instance
     *
     * @return string
     */
    public function getSku()
    {
        return $this->_getData(self::SKU);
    }
    
    /**
     * Retrieve weight through type instance
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->_getData(self::WEIGHT);
    }
    
    /**
     * Get product price through type instance
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->_getData(self::PRICE);
    }
    
    /**
     * Get product old price through type instance
     *
     * @return float
     */
    public function getOldPrice()
    {
        return $this->_getData(self::OLDPRICE);
    }
    
    /**
     * Retrieve Product URL
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->_getData(self::URL);
    }
    
    /**
     * Get product image from it's child if possible
     *
     * @return string
     */
    public function getImage()
    {
        return $this->_getData(self::IMAGE);
    }
    
    /**
     * Get params code array
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Get product vendor
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->_getData(self::VENDOR);
    }
    
    /**
     * Get product vendor code
     *
     * @return string
     */
    public function getVendorCode()
    {
        return $this->_getData(self::VENDOR_CODE);
    }

    /**
     * Set entity Id
     *
     * @param int $value
     * @return $this
     */
    public function setId($value)
    {
        return $this->setData(self::ID, $value);
    }
    
    /**
     * 
     * @param type $categoryId
     * @return type
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }
    
    
    
     /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Set product name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    
    /**
     * Set product description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }
    
    /**
     * Set product warranty
     *
     * @param string $warranty
     * @return $this
     */
    public function setWarranty($warranty)
    {
        return $this->setData(self::WARRANTY, $warranty);
    }
    
    /**
     * Set product country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }
    
    /**
     * Set product price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }
    
    /**
     * Set product old price
     *
     * @param float $price
     * @return $this
     */
    public function setOldPrice($price)
    {
        return $this->setData(self::OLDPRICE, $price);
    }
    
    /**
     * Set product url
     *
     * @param string $url
     * @return $this
     */
    public function setProductUrl($url)
    {
        return $this->setData(self::URL, $url);
    }
    
    /**
     * Set product weight
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        return $this->setData(self::WEIGHT, $weight);
    }
    
    /**
     * Set product image
     * 
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }
    
    /**
     * Set params
     * 
     * @param array $params
     * @return $this
     */
    public function setParams($params)
    {
        $this->params[] = $params;
        return $this;
    }
    
    /**
     * Set product vendor
     *
     * @param string $vendor
     * @return $this
     */
    public function setVendor($vendor)
    {
        return $this->setData(self::VENDOR, $vendor);
    }
    
    /**
     * Set product vendor code
     *
     * @param string $vendorCode
     * @return $this
     */
    public function setVendorCode($vendorCode)
    {
        return $this->setData(self::VENDOR_CODE, $vendorCode);
    }
}