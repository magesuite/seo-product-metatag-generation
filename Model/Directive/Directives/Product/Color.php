<?php

namespace MageSuite\SeoProductMetatagGeneration\Model\Directive\Directives\Product;

class Color extends \MageSuite\DynamicDirectives\Model\Directive
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getValue()
    {
        $product = $this->getProduct();

        if (empty($product)) {
            return null;
        }

        return $product->getColor() ? $product->getAttributeText('color') : null;
    }

    protected function getProduct()
    {
        return $this->registry->registry('product');
    }
}
