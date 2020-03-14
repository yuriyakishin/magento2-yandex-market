<?php

namespace Yu\YandexMarket\Model\Price;

/**
 * Класс создает прайс в формате XML и выводит его в строку
 */
class Yml implements \Yu\YandexMarket\Api\PriceInterface
{

    /**
     * @var \Yu\YandexMarket\Api\MarketBuilderInterface
     */
    private $marketBuilder;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var int 
     */
    private $storeId;

    /**
     * @var \Yu\YandexMarket\Model\Config\MarketConfig 
     */
    private $marketConfig;

    public function __construct(
            \Magento\Store\Model\StoreManagerInterface $storyManager,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            \Yu\YandexMarket\Model\Config\MarketConfig $marketConfig,
            \Yu\YandexMarket\Api\MarketBuilderInterface $marketBuilder
    )
    {
        $this->marketBuilder = $marketBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->storeId = $storyManager->getDefaultStoreView()->getId();
        $this->marketConfig = $marketConfig;
    }

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getPrice($storeId = null)
    {
        if ($storeId !== null) {
            $this->storeId = $storeId;
        }

        $this->marketConfig->setStoryId($this->storeId);

        if ($this->scopeConfig->getValue($this->marketConfig::SHOP_ACTIVE, 'store', $this->storeId) == 0) {
            return '';
        }

        $yml = new \DOMDocument('1.0', 'UTF-8');
        $yml->formatOutput = true;

        $yml_catalog = $yml->createElement(self::KEY_YML);
        $yml_catalog->setAttribute('date', date('Y-m-d H:i'));
        $yml->appendChild($yml_catalog);

        $yml_shop = $yml->createElement(self::KEY_SHOP);
        $yml_catalog->appendChild($yml_shop);

        $yml_shop_name = $yml->createElement(self::KEY_SHOP_NAME);
        $yml_shop_name->appendChild($yml->createTextNode($this->marketConfig->getShopName()));
        $yml_shop->appendChild($yml_shop_name);

        $yml_shop_company = $yml->createElement(self::KEY_SHOP_COMPANY);
        $yml_shop_company->appendChild($yml->createTextNode($this->marketConfig->getShopCompany()));
        $yml_shop->appendChild($yml_shop_company);
        
        $yml_shop_url = $yml->createElement(self::KEY_SHOP_URL);
        $yml_shop_url->appendChild($yml->createTextNode($this->marketConfig->getShopUrl()));
        $yml_shop->appendChild($yml_shop_url);

        $yml_shop_platform = $yml->createElement(self::KEY_SHOP_PLATFORM);
        $yml_shop_platform->appendChild($yml->createTextNode($this->marketConfig->getShopPlatform()));
        $yml_shop->appendChild($yml_shop_platform);

        $yml_shop_version = $yml->createElement(self::KEY_SHOP_VERSION);
        $yml_shop_version->appendChild($yml->createTextNode($this->marketConfig->getShopVersion()));
        $yml_shop->appendChild($yml_shop_version);

        $yml_currencies = $yml->createElement(self::KEY_SHOP_CURRENCIES);
        $yml_shop->appendChild($yml_currencies);

        $yml_shop_currency = $yml->createElement(self::KEY_SHOP_CURRENCY);
        //$yml_shop_currency->appendChild($yml->createTextNode($this->marketConfig->getShopCurrency()));
        $yml_shop_currency->setAttribute('id', $this->marketConfig->getShopCurrency());
        $yml_currencies->appendChild($yml_shop_currency);

        $yml_categories = $yml->createElement(self::KEY_CATEGORIES);
        $yml_shop->appendChild($yml_categories);

        /** @var \Yu\YandexMarket\Api\Data\MarketInterface $market */
        $market = $this->marketBuilder->getMarket($storeId);

        /** @var \Yu\YandexMarket\Api\Data\CategoryInterface $category */
        foreach ((array) $market->getCategories() as $category)
        {
            $yml_category = $yml->createElement(self::KEY_CATEGORY);
            $yml_categories->appendChild($yml_category);
            $yml_category->setAttribute(self::KEY_CATEGORY_ID, $category->getCategoryId());
            if (!empty($category->getParentId()) && $category->getLevel()>2) {
                $yml_category->setAttribute(self::KEY_CATEGORY_PARENT_ID, $category->getParentId());
            }

            //$yml_category_name = $yml->createElement(self::KEY_CATEGORY_NAME);
            //$yml_category->appendChild($yml_category_name);
            $yml_category->appendChild($yml->createTextNode($category->getName()));
        }

        $yml_offers = $yml->createElement(self::KEY_OFFERS);
        $yml_shop->appendChild($yml_offers);

        /** @var \Yu\YandexMarket\Api\Data\ProductInterface $product */
        foreach ((array) $market->getProducts() as $product)
        {
            $yml_offer = $yml->createElement(self::KEY_OFFER);
            $yml_offer->setAttribute(self::KEY_OFFER_ID, $product->getId());
            $yml_offers->appendChild($yml_offer);

            $yml_offer_name = $yml->createElement(self::KEY_OFFER_NAME);
            $yml_offer_name->appendChild($yml->createTextNode($product->getName()));
            $yml_offer->appendChild($yml_offer_name);

            $yml_offer_category = $yml->createElement(self::KEY_OFFER_CATEGORY_ID);
            $yml_offer_category->appendChild($yml->createTextNode($product->getCategoryId()));
            $yml_offer->appendChild($yml_offer_category);

            $yml_offer_price = $yml->createElement(self::KEY_OFFER_PRICE);
            $yml_offer_price->appendChild($yml->createTextNode($product->getPrice()));
            $yml_offer->appendChild($yml_offer_price);

            if (!empty($product->getOldPrice())) {
                $yml_offer_oldprice = $yml->createElement(self::KEY_OFFER_OLDPRICE);
                $yml_offer_oldprice->appendChild($yml->createTextNode($product->getOldPrice()));
                $yml_offer->appendChild($yml_offer_oldprice);
            }

            $yml_offer_url = $yml->createElement(self::KEY_OFFER_URL);
            $yml_offer_url->appendChild($yml->createTextNode($product->getProductUrl()));
            $yml_offer->appendChild($yml_offer_url);

            $yml_offer_picture = $yml->createElement(self::KEY_OFFER_PICTURE);
            $yml_offer_picture->appendChild($yml->createTextNode($product->getImage()));
            $yml_offer->appendChild($yml_offer_picture);

            if (!empty($this->marketConfig->getVendor())) {
                $yml_offer_vendor = $yml->createElement(self::KEY_OFFER_VENDOR);
                $yml_offer_vendor->appendChild($yml->createTextNode($product->getVendor()));
                $yml_offer->appendChild($yml_offer_vendor);
            }

            if (!empty($this->marketConfig->getVendorCode())) {
                $yml_offer_vendor_code = $yml->createElement(self::KEY_OFFER_VENDOR_CODE);
                $yml_offer_vendor_code->appendChild($yml->createTextNode($product->getVendorCode()));
                $yml_offer->appendChild($yml_offer_vendor_code);
            }
            
            if (!empty($this->marketConfig->getWarranty())) {
                $yml_offer_warranty = $yml->createElement(self::KEY_OFFER_WARRANTY);
                $yml_offer_warranty->appendChild($yml->createTextNode($product->getWarranty()));
                $yml_offer->appendChild($yml_offer_warranty);
            }

            if (!empty($this->marketConfig->getDescription())) {
                $yml_offer_description = $yml->createElement(self::KEY_OFFER_DESCRIPTION);
                $yml_offer_description->appendChild($yml->createTextNode($product->getDescription()));
                $yml_offer->appendChild($yml_offer_description);
            }

            $params = $product->getParams();
            foreach ($params as $param)
            {
                $yml_param = $yml->createElement(self::KEY_PARAM);
                $yml_param->setAttribute(self::KEY_PARAM_NAME, $param['label']);
                $yml_param->appendChild($yml->createTextNode($param['value']));
                $yml_offer->appendChild($yml_param);
            }
        }

        return $yml->saveXML();
    }

}
