<?php

namespace Yu\YandexMarket\Api;

interface PriceInterface
{

    const KEY_YML = 'yml_catalog';
    const KEY_SHOP = 'shop';
    const KEY_SHOP_NAME = 'name';
    const KEY_SHOP_COMPANY = 'company';
    const KEY_SHOP_PLATFORM = 'platform';
    const KEY_SHOP_VERSION = 'version';
    const KEY_SHOP_URL = 'url';
    const KEY_SHOP_CURRENCIES = 'currencies';
    const KEY_SHOP_CURRENCY = 'currency';
    const KEY_CATEGORIES = 'categories';
    const KEY_CATEGORY = 'category';
    const KEY_CATEGORY_ID = 'id';
    const KEY_CATEGORY_PARENT_ID = 'parentId';
    const KEY_CATEGORY_NAME = 'name';
    const KEY_OFFERS = 'offers';
    const KEY_OFFER = 'offer';
    const KEY_OFFER_ID = 'id';
    const KEY_OFFER_NAME = 'name';
    const KEY_OFFER_SKU = 'sku';
    const KEY_OFFER_PRICE = 'price';
    const KEY_OFFER_OLDPRICE = 'oldprice';
    const KEY_OFFER_URL = 'url';
    const KEY_OFFER_CURRENCY_ID = 'currencyId';
    const KEY_OFFER_CATEGORY_ID = 'categoryId';
    const KEY_OFFER_WEIGHT = 'weight';
    const KEY_OFFER_PICTURE = 'picture';
    const KEY_OFFER_VENDOR = 'vendor';
    const KEY_OFFER_VENDOR_CODE = 'vendor_code';
    const KEY_OFFER_DESCRIPTION = 'description';
    const KEY_OFFER_COUNTRY = 'country_of_origin';
    const KEY_OFFER_WARRANTY = 'manufacturer_warranty';
    const KEY_PARAM = 'param';
    const KEY_PARAM_NAME = 'name';

    /**
     * @param int|null
     * return string|array|null
     */
    public function getPrice($storeId = null);
}
