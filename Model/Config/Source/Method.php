<?php

namespace Yu\YandexMarket\Model\Config\Source;

/**
 * Method source
 */
class Method implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Returns array to be used in multiselect on back-end
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => 'price_file_xml', 'label' => 'Создавать XML файл'],
            ['value' => 'price_url', 'label' => 'Генерировать XML по прямой ссылке'],
        ];
        return $options;
    }

}
