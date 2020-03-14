<?php

namespace Yu\YandexMarket\Model;

use \Yu\YandexMarket\Model\Config\MarketConfig as MarketConfig;

/**
 * Создает объект маркета
 */
class MarketBuilder implements \Yu\YandexMarket\Api\MarketBuilderInterface
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\Collection\Factory 
     */
    private $categoryCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory 
     */
    private $productCollectionFactory;

    /**
     * @var \Yu\YandexMarket\Api\Data\CategoryInterfaceFactory 
     */
    private $categoryMarketFactory;

    /**
     * @var \Yu\YandexMarket\Api\Data\ProductInterfaceFactory 
     */
    private $productMarketFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    private $storeManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Yu\YandexMarket\Model\Config\MarketConfig 
     */
    private $marketConfig;

    /**
     * @var \Yu\YandexMarket\Model\Market 
     */
    private $market;

    /**
     * @var int 
     */
    private $storeId;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    private $imageHelper;

    /**
     * @param \Yu\YandexMarket\Helper\ProductUrl $productUrlHelper
     */
    private $productUrlHelper;

    public function __construct(
            \Magento\Catalog\Model\ResourceModel\Category\Collection\Factory $categoryCollectionFactory,
            \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            \Magento\Catalog\Helper\Image $imageHelper,
            \Yu\YandexMarket\Api\Data\CategoryInterfaceFactory $categoryMarketFactory,
            \Yu\YandexMarket\Api\Data\ProductInterfaceFactory $productMarketFactory,
            \Yu\YandexMarket\Model\Config\MarketConfig $marketConfig,
            \Yu\YandexMarket\Model\Market $market,
            \Yu\YandexMarket\Helper\ProductUrl $productUrlHelper
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryMarketFactory = $categoryMarketFactory;
        $this->productMarketFactory = $productMarketFactory;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->imageHelper = $imageHelper;
        $this->storeId = $storeManager->getDefaultStoreView()->getId();
        $this->marketConfig = $marketConfig;
        $this->market = $market;
        $this->productUrlHelper = $productUrlHelper;
    }

    /**
     * @return \Yu\YandexMarket\Api\Data\MarketInterface
     */
    public function getMarket($storeId = null)
    {
        if ($storeId !== null) {
            $this->storeId = $storeId;
        }

        if ($this->scopeConfig->getValue(MarketConfig::SHOP_ACTIVE, 'store', $this->storeId) == 0) {
            return null;
        }

        $this->market->setCategories($this->createCaregories());
        $this->market->setProducts($this->createProducts());

        return $this->market;
    }

    /**
     * @return \Yu\YandexMarket\Api\Data\CategoryInterface []
     */
    public function createCaregories()
    {
        /** @var \Yu\YandexMarket\Api\Data\CategoryInterface [] $categories */
        $categories = array();

        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $categoryCollection */
        $categoryCollection = $this->categoryCollectionFactory->create();
        $categoryCollection
                ->addAttributeToSelect(['id', 'name'])
                ->setStore($this->storeId)
                ->addIdFilter($this->marketConfig->getCategories());

        foreach ($categoryCollection as $category)
        {
            /** @var \Yu\YandexMarket\Api\Data\CategoryInterface $categoryMarket */
            $categoryMarket = $this->categoryMarketFactory->create();

            $categoryMarket
                    ->setCategoryId($category->getId())
                    ->setParentId($category->getParentId())
                    ->setLevel($category->getLevel())
                    ->setName($category->getName());

            $categories[] = $categoryMarket;
        }

        return $categories;
    }

    /**
     * @return \Yu\YandexMarket\Api\Data\ProductInterface[]
     */
    public function createProducts()
    {
        if (empty($this->marketConfig->getCategories())) {
            return [];
        };
        /** @var \Yu\YandexMarket\Api\Data\ProductInterface [] $products */
        $products = [];

        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection
                ->setStoreId($this->storeId)
                ->addAttributeToSelect('*')
                ->addStoreFilter($this->storeId)                
                ->addFieldToFilter('type_id', 'simple')
                ->addCategoriesFilter(['in' => $this->marketConfig->getCategories()]);

        /** @var \Magento\Catalog\Model\Product $product */
        foreach ($productCollection as $product)
        {
            /** @var \Yu\YandexMarket\Api\Data\ProductInterface $productMarket */
            $productMarket = $this->productMarketFactory->create();

            $productMarket->setId($product->getId());
            //$productMarket->setName($product->getName());
            $productMarket->setCategoryId($product->getCategoryIds()[0]);

            if (!empty($product->getSpecialPrice())) {
                $productMarket->setPrice($product->getSpecialPrice());
                $productMarket->setOldPrice($product->getPrice());
            } else {
                $productMarket->setPrice($product->getPrice());
            }

            $productMarket->setProductUrl($this->productUrlHelper->getUrl($product));
            $productMarket->setSku($product->getSku());
            $productMarket->setWeight($product->getWeight());
            $productMarket->setImage($product->getMediaConfig()->getMediaUrl($product->getImage()));

            $offerParams = $this->marketConfig->getParams();
            /**
             * @return \Magento\Catalog\Model\Category\Attribute $attr *\
             */
            foreach ($product->getAttributes() as $attr)
            {
                if ($attr->getAttributeCode() == $this->marketConfig->getName()) {
                    $productMarket->setName($attr->getFrontend()->getValue($product));
                }

                if (!empty($this->marketConfig->getVendor()) && ($attr->getAttributeCode() == $this->marketConfig->getVendor())) {
                    $productMarket->setVendor($attr->getFrontend()->getValue($product));
                }

                if (!empty($this->marketConfig->getVendorCode()) && ($attr->getAttributeCode() == $this->marketConfig->getVendorCode())) {
                    $productMarket->setVendorCode($attr->getFrontend()->getValue($product));
                }

                if (!empty($this->marketConfig->getDescription()) && ($attr->getAttributeCode() == $this->marketConfig->getDescription())) {
                    $productMarket->setDescription($attr->getFrontend()->getValue($product));
                }

                if (!empty($this->marketConfig->getWarranty()) && ($attr->getAttributeCode() == $this->marketConfig->getWarranty())) {
                    $productMarket->setWarranty($attr->getFrontend()->getValue($product));
                }

                if (!empty($this->marketConfig->getCountry()) && ($attr->getAttributeCode() == $this->marketConfig->getCountry())) {
                    $productMarket->setCountry($attr->getFrontend()->getValue($product));
                }

                if (in_array($attr->getAttributeCode(), $offerParams)) {
                    if (!empty($attr->getFrontend()->getValue($product))) {
                        $param = [
                            'label' => ( $this->marketConfig->getParamLabel() == 'frontend' ? $attr->getStoreLabel() : $attr->getFrontend()->getLabel() ),
                            'value' => ( $this->marketConfig->getParamValue() == 'frontend' ? $attr->getFrontend()->getValue($product) : $attr->getFrontend()->getValue($product) )
                        ];
                        $productMarket->setParams($param);
                    }
                }
            }

            $products[] = $productMarket;
        }

        return $products;
    }

}
