<?php

namespace Yu\YandexMarket\Block\Adminhtml\System\Config;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Config\Block\System\Config\Form\Field;

class UrlXMLMethod extends Field
{
    /**
     * @var int 
     */
    private $_storeId;
    
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;
    
    private $url;
    
    public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            \Magento\Framework\Url $url,
            array $data = array()
            )
    {
        parent::__construct($context, $data);
        $this->_storeId = $this->getRequest()->getParam('store');
        $this->scopeConfig = $scopeConfig;
        $this->url = $url;
    }
    /**
     * @inheritdoc
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->url->setUseSession(false);
        $url = $this->url->getUrl('yandex_market',['store' => $this->_storeId]);
        return '<p>' . $url . '</p>';
    }
}
