<?php

namespace Yu\YandexMarket\Model\Config\Source;

class Param implements \Magento\Framework\Data\OptionSourceInterface
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
     * Returns array to be used in multiselect on back-end
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();

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
