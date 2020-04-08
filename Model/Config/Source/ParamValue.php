<?php

namespace Yu\YandexMarket\Model\Config\Source;

class ParamValue implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Returns array to be used in select on back-end
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => 'frontend', 'label' => 'Frontend (Как на сайте)'],
            ['value' => 'backend', 'label' => 'Backend (Как в админке)'],
        ];
        return $options;
    }
}
