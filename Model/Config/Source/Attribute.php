<?php

namespace Yu\YandexMarket\Model\Config\Source;

class Attribute implements \Magento\Shipping\Model\Carrier\Source\GenericInterface
{

    /**
     *
     * @var Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory
     */
    private $attributeCollectionFactory;

    /**
     * @param \Yu\YandexMarket\Model\Config\Source\Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributeCollectionFactory
     */
    public function __construct(
            \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributeCollectionFactory
    )
    {
        $this->attributeCollectionFactory = $attributeCollectionFactory;
    }

    /**
     * Returns array to be used in select on back-end
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = [
                'value' => '0',
                'label' => '-',
            ];

        $attributeCollection = $this->attributeCollectionFactory->create();
        $attributeCollection->addVisibleFilter();
        $attributeCollection->addOrder('frontend_label','ASC');

        /**
         * @var \Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute *\
         */
        foreach ($attributeCollection as $attribute)
        {
            $options[] = [
                'value' => $attribute->getAttributeCode(),
                'label' => $attribute->getFrontend()->getLabel() . ' (' . $attribute->getAttributeCode() . ')',
            ];
        }
        return $options;
    }

}
