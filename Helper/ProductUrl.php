<?php

namespace Yu\YandexMarket\Helper;

use Magento\Catalog\Model\Product\Visibility;

class ProductUrl extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable
     */
    private $configurable;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
            \Magento\Framework\App\Helper\Context $context,
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
            \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurable
    )
    {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->configurable = $configurable;
    }

    /** 
     * @param \Magento\Catalog\Model\Product $product
     * @return boolean|string
     */
    public function getUrl($product)
    {

        if ($product->getVisibility() != Visibility::VISIBILITY_NOT_VISIBLE) {
            return $product->getProductUrl();
        }

        $configProductIds = $this->configurable->getParentIdsByChild($product->getId());

        if (is_array($configProductIds) && empty($configProductIds)) {
            return '#';
        }

        if (is_array($configProductIds) && !empty($configProductIds)) {
            $configProductId = $configProductIds[0];
        }
        if (is_int($configProductIds)) {
            $configProductId = $configProductIds;
        }

        try {
            $configurablProduct = $this->productRepository
                    ->getById($configProductId, false, $product->getStoreId());
        } catch (\Magento\Framework\Exception\NoSuchEntityException $ex) {
            return false;
        }

        return $configurablProduct->getUrlModel()->getUrl($configurablProduct);
    }

}
