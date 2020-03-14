<?php

namespace Yu\YandexMarket\Block\Adminhtml\System\Config;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Config\Block\System\Config\Form\Field;

class FileXMLMethod extends Field
{
    /**
     * @var int 
     */
    private $_storeId;
    
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;
    
    /**
     * @var \Magento\Framework\Url
     */
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
    public function getTemplate()
    {
        return 'Yu_YandexMarket::file-xml-method.phtml';
    }
    
    /**
     * @inheritdoc
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $html = $this->_toHtml();
        return $html;
    }
    
    /**
     * @return string
     */
    public function getFileUrl()
    {
        $this->url->setUseSession(false);
        $url = $this->url->getBaseUrl();
        return '' . $url . 'market_' . $this->_storeId . '.xml';
    }
}
