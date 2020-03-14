<?php

namespace Yu\YandexMarket\Model\Config\Source;

class Category implements \Magento\Shipping\Model\Carrier\Source\GenericInterface
{

    /**
     * @var \Magento\Catalog\Block\Adminhtml\Category\Tree
     */
    private $categotyTree;

    /**
     * @param \Magento\Catalog\Block\Adminhtml\Category\Tree $categotyTree
     */
    public function __construct(
            \Magento\Catalog\Block\Adminhtml\Category\Tree $categotyTree
    )
    {
        $this->categotyTree = $categotyTree;
    }

    /**
     * Returns array to be used in multiselect on back-end
     *
     * @return array
     */
    public function toOptionArray()
    {
        $tree = $this->categotyTree->getTree();
        $options = array();
        $this->createOptionsFromTree($tree, $options);
        return $options;
    }

    /**
     * @param type $tree
     * @param type $options
     */
    private function createOptionsFromTree($tree, &$options)
    {
        foreach ($tree as $cat)
        {
            $path = explode('/', $cat['path']);

            if (count($path) <= 2) {
                $options[] = ['value' => $cat['id'], 'label' => $cat['text'], 'style' => '" disabled=disabled"'];
            } else {
                $pref = str_repeat('-', count($path) - 2) . ' ';
                $options[] = ['value' => $cat['id'], 'label' => $pref . $cat['text']];
            }

            if (isset($cat['children'])) {
                $this->createOptionsFromTree($cat['children'], $options);
            }
        }
    }

}
