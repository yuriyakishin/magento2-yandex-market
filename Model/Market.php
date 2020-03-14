<?php

namespace Yu\YandexMarket\Model;

class Market implements \Yu\YandexMarket\Api\Data\MarketInterface
{
    /**
     * @var \Yu\YandexMarket\Api\Data\CategoryInterface[]
     */
    private $categories;
    
    /**
     * @var \Yu\YandexMarket\Api\Data\ProductInterface[]
     */
    private $products;
    
    /**
     * @param \Yu\YandexMarket\Api\Data\CategoryInterface[] $categories
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }
    
    /**
     * @param \Yu\YandexMarket\Api\Data\ProductInterface[] $products
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
    }
    
    /**
     * @return \Yu\YandexMarket\Api\Data\CategoryInterface[]|[]
     */
    public function getCategories()
    {
        if(empty($this->categories)) {
            return [];
        }
        
        return $this->categories;
    }

    /**
     * 
     * @return \Yu\YandexMarket\Api\Data\ProductInterface[]|null
     */
    public function getProducts()
    {
        if(empty($this->products)) {
            return null;
        }
        
        return $this->products;
    }

}
