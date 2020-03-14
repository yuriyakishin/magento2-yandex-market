<?php

namespace Yu\YandexMarket\Api;

interface MarketBuilderInterface
{

    /**
     * @param int|null
     * @return \Yu\YandexMarket\Api\Data\MarketInterface|null
     */
    public function getMarket($storyId = null);
}
