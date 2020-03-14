<?php

namespace Yu\YandexMarket\Model\Config;

/**
 * Системная конфигурация прайса
 */
class MarketConfig
{

    const SHOP_ACTIVE = 'yandex_market/shop/active';
    const SHOP_NAME = 'yandex_market/shop/name';
    const SHOP_COMPANY = 'yandex_market/shop/company';
    const SHOP_URL = 'yandex_market/shop/url';
    const SHOP_METHOD = 'yandex_market/shop/allowed_methods';
    const SHOP_CATEGORIES = 'yandex_market/offer/category';
    const OFFER_PARAMS = 'yandex_market/offer/param';
    const OFFER_NAME = 'yandex_market/offer/name';
    const OFFER_VENDOR = 'yandex_market/offer/vendor';
    const OFFER_VENDOR_CODE = 'yandex_market/offer/vendor_code';
    const OFFER_DESCRIPTION = 'yandex_market/offer/description';
    const OFFER_WARRANTY = 'yandex_market/offer/manufacturer_warranty';
    const OFFER_COUNTRY = 'yandex_market/offer/country';
    const OFFER_PARAM_LABEL = 'yandex_market/offer/param_label';
    const OFFER_PARAM_VALUE = 'yandex_market/offer/param_value';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    private $storeManager;

    /**
     * @var int 
     */
    private $storeId;

    public function __construct(
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->storeId = $storeManager->getDefaultStoreView()->getId();
    }

    /**
     * @return string
     */
    public function getShopName()
    {
        return $this->scopeConfig->getValue(self::SHOP_NAME, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getShopCompany()
    {
        return $this->scopeConfig->getValue(self::SHOP_COMPANY, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getShopUrl()
    {
        return $this->scopeConfig->getValue(self::SHOP_URL, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getShopPlatform()
    {
        return 'Magento';
    }

    /**
     * @return string
     */
    public function getShopVersion()
    {
        $productMetadata = \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Framework\App\ProductMetadata::class);
        $version = $productMetadata->getVersion();
        return $version;
    }

    /**
     * @return string
     */
    public function getShopCurrency()
    {
        return $this->storeManager->getStore($this->storeId)->getCurrentCurrency()->getCode();
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $categories = $this->scopeConfig->getValue(self::SHOP_CATEGORIES, 'store', $this->storeId);
        return explode(',', $categories);
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->scopeConfig->getValue(self::OFFER_NAME, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->scopeConfig->getValue(self::OFFER_VENDOR, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getVendorCode()
    {
        return $this->scopeConfig->getValue(self::OFFER_VENDOR_CODE, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->scopeConfig->getValue(self::OFFER_DESCRIPTION, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getWarranty()
    {
        return $this->scopeConfig->getValue(self::OFFER_WARRANTY, 'store', $this->storeId);
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->scopeConfig->getValue(self::OFFER_COUNTRY, 'store', $this->storeId);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $params = $this->scopeConfig->getValue(self::OFFER_PARAMS, 'store', $this->storeId);
        return explode(',', $params);
    }
    
    /**
     * @return string
     */
    public function getParamLabel()
    {
        return $this->scopeConfig->getValue(self::OFFER_PARAM_LABEL, 'store', $this->storeId);
    }
    
    /**
     * @return string
     */
    public function getParamValue()
    {
        return $this->scopeConfig->getValue(self::OFFER_PARAM_VALUE, 'store', $this->storeId);
    }

    /**
     * @return array
     */
    public function getMethod()
    {
        $params = $this->scopeConfig->getValue(self::SHOP_METHOD, 'store', $this->storeId);
        return explode(',', $params);
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        if ($this->scopeConfig->getValue(self::SHOP_ACTIVE, 'store', $this->storeId) == 1) {
            return true;
        }
        return false;
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoryId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

}
