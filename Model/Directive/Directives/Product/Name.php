<?php

namespace MageSuite\SeoProductMetatagGeneration\Model\Directive\Directives\Product;

class Name extends \MageSuite\DynamicDirectives\Model\Directive
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

        return $product->getName();
    }

    protected function getProduct()
    {
        $product = $this->registry->registry('product');

        return ($product && $product->getId()) ? $product : null;
    }
}
