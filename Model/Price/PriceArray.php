<?php

namespace Yu\YandexMarket\Model\Price;

/**
 * Создает прайс ввиде массива
 */
class PriceArray implements \Yu\YandexMarket\Api\PriceInterface
{

    /**
     * @var \Yu\YandexMarket\Api\MarketBuilderInterface
     */
    private $marketBuilder;

    public function __construct(
            \Yu\YandexMarket\Api\MarketBuilderInterface $marketBuilder
    )
    {
        $this->marketBuilder = $marketBuilder;
    }

    /** TODO function getPrice **/
    public function getPrice($storeId = null)
    {
        /** @var array */
        $price = array();

        /** @var \Yu\YandexMarket\Api\Data\MarketInterface $market */
        $market = $this->marketBuilder->getMarket();

        $price[self::KEY_SHOP][self::KEY_SHOP_NAME] = '';
        $price[self::KEY_SHOP][self::KEY_SHOP_COMPANY] = '';
        $price[self::KEY_SHOP][self::KEY_SHOP_URL] = '';

        /** @var \Yu\YandexMarket\Api\Data\CategoryInterface $category */
        foreach ($market->getCategories() as $category)
        {
            $price[self::KEY_SHOP][self::KEY_CATEGORIES][] = [
                self::KEY_CATEGORY => [
                    self::KEY_CATEGORY_ID        => $category->getCategoryId(),
                    self::KEY_CATEGORY_PARENT_ID => $category->getParentId(),
                    self::KEY_CATEGORY_NAME      => $category->getName(),
                ]
            ];
        }

        /** @var \Yu\YandexMarket\Api\Data\ProductInterface $product */
        foreach ($market->getProducts() as $product)
        {
            $price[self::KEY_SHOP][self::KEY_OFFERS][] = [
                self::KEY_OFFER => [
                    self::KEY_OFFER_ID   => $product->getId(),
                    self::KEY_OFFER_NAME => $product->getName(),
                    self::KEY_OFFER_SKU  => $product->getSku(),
                ]
            ];
        }


        return $price;
    }

}
