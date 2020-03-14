<?php

namespace Yu\YandexMarket\Service;

/**
 * Класс создает xml файлы для маркета
 */
class CreateXMLFile implements \Yu\YandexMarket\Api\CreateXMLFileInterface
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    private $storeManager;

    /**
     * @var \Yu\YandexMarket\Model\Price\Yml
     */
    private $yml;

    /**
     * @var \Yu\YandexMarket\Model\Config\MarketConfig 
     */
    private $marketConfig;

    /** 
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Yu\YandexMarket\Model\Price\Yml $yml
     * @param \Yu\YandexMarket\Model\Config\MarketConfig $marketConfig
     */
    public function __construct(
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Yu\YandexMarket\Model\Price\Yml $yml,
            \Yu\YandexMarket\Model\Config\MarketConfig $marketConfig
    )
    {
        $this->storeManager = $storeManager;
        $this->yml = $yml;
        $this->marketConfig = $marketConfig;
    }

    /**
     * @return boolean
     */
    public function execute()
    {
        $stores = $this->storeManager->getStores();
        foreach ($stores as $store)
        {
            $storeId = $store->getId();
            $this->marketConfig->setStoryId($storeId);

            if ($this->marketConfig->isActive() && in_array('price_file_xml', $this->marketConfig->getMethod())) {
                $price = $this->yml->getPrice($storeId);
                file_put_contents('market_' . $storeId . '.xml', $price);
            }
        }
        
        return true;
    }

}
