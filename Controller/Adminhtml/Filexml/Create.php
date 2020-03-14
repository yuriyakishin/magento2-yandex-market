<?php

namespace Yu\YandexMarket\Controller\Adminhtml\Filexml;

class Create extends \Magento\Backend\App\Action
{


    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Backend::stores_settings';
    
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Yu\YandexMarket\Service\CreateXMLFile
     */
    private $file;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Yu\YandexMarket\Service\CreateXMLFile $file
     */
    public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
            \Yu\YandexMarket\Service\CreateXMLFile $file
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->file = $file;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $this->file->execute();
        $data = ['status' => 'OK'];
        return $this->resultJsonFactory->create()->setData($data);
    }

}
