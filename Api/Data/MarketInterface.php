<?php

namespace Yu\YandexMarket\Api\Data;

interface MarketInterface
{
    /**
     * @return \Yu\YandexMarket\Api\Data\CategoryInterface[]|[]
     */
    public function getCategories();

    /**
     * @return \Yu\YandexMarket\Api\Data\ProductInterface[]|null
     */
    public function getProducts();
}
