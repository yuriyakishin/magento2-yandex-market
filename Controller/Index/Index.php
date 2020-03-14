<?php

namespace Yu\YandexMarket\Controller\Index;

/**
 * Отдает прайс.
 */
class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Yu\YandexMarket\Model\Config\MarketConfig 
     */
    private $marketConfig;
    
    /**
     * @var \Yu\YandexMarket\Model\Price\Yml
     */
    private $price;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\RawFactory $resultFactory
     * @param \Yu\YandexMarket\Model\Price\Yml $price
     */
    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\Controller\Result\RawFactory $resultFactory,
            \Yu\YandexMarket\Model\Config\MarketConfig $marketConfig,
            \Yu\YandexMarket\Model\Price\Yml $price)
    {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->marketConfig = $marketConfig;
        $this->price = $price;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $storeId = $this->getRequest()->getParam('store');
        
        $this->marketConfig->setStoryId($storeId);
        if (!$this->marketConfig->isActive() || !in_array('price_url',$this->marketConfig->getMethod())) {
            return '';
        }

        $this->getResponse()->setHeader('Content-Type', 'application/xml', true);
        return $this->resultFactory->create()->setContents($this->price->getPrice($storeId));
    }

}
