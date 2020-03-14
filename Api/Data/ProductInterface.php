<?php

namespace Yu\YandexMarket\Api\Data;

interface ProductInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const ID = 'product_id';    
    const CATEGORY_ID = 'category_id';    
    const SKU = 'sku';
    const NAME = 'name';
    const PRICE = 'price';    
    const OLDPRICE = 'oldprice';
    const WEIGHT = 'weight';    
    const URL = 'url';    
    const IMAGE = 'image';    
    const VENDOR = 'vendor';
    const DESCRIPTION = 'description';
    const WARRANTY = 'warranty';
    const COUNTRY = 'country';
    const VENDOR_CODE = 'vendor_code';    
    const PARAMS = 'params';

    /**#@-*/

    /**
     * Product id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);
    
    /**
     * Product category Id
     *
     * @return int|null
     */
    public function getCategoryId();

    /**
     * Set product category
     *
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId);

    /**
     * Product sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);
    
    /**
     * Product description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set product description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description);
    
     /**
     * Product warranty
     *
     * @return string
     */
    public function getWarranty();

    /**
     * Set product warranty
     *
     * @param string $warranty
     * @return $this
     */
    public function setWarranty($warranty);
    
    /**
     * Product country
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set product country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * Product name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set product name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);
    
    /**
     * Product price
     *
     * @return float|null
     */
    public function getPrice();

    /**
     * Set product price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);
    
    /**
     * Product price
     *
     * @return float|null
     */
    public function getOldPrice();

    /**
     * Set product price
     *
     * @param float $price
     * @return $this
     */
    public function setOldPrice($price);
    
    /**
     * Product weight
     *
     * @return float|null
     */
    public function getWeight();

    /**
     * Set product weight
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight);
    
    /**
     * Get product links info
     *
     * @return string
     */
    public function getProductUrl();

    /**
     * Set product links info
     *
     * @param string $url
     * @return $this
     */
    public function setProductUrl($url);
    
    /**
     * Get product image
     *
     * @return string
     */
    public function getImage();

    /**
     * Set product image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image);
    
    /**
     * Get product params
     *
     * @return array
     */
    public function getParams();
    
    /** 
     * @param array $params
     * @return $this
     */
    public function setParams($params);
    
    /**
     * Get product vendor
     *
     * @return string
     */
    public function getVendor();
    
    /**
     * Set product vendor
     *
     * @param string $vendor
     * @return $this
     */
    public function setVendor($vendor);
    
    /**
     * Get product vendor code
     *
     * @return string
     */
    public function getVendorCode();
    
    /**
     * Set product vendor code
     *
     * @param string $vendorCode
     * @return $this
     */
    public function setVendorCode($vendorCode);
}
