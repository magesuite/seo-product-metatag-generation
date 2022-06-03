<?php

namespace MageSuite\SeoProductMetatagGeneration\Model\Directive\Directives\Product;

class Brand extends \MageSuite\DynamicDirectives\Model\Directive
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \MageSuite\SeoProductMetatagGeneration\Helper\Configuration
     */
    protected $configuration;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \MageSuite\SeoProductMetatagGeneration\Helper\Configuration $configuration
    ) {
        $this->registry = $registry;
        $this->configuration = $configuration;
    }

    public function getValue()
    {
        $brandAttributeCode = $this->configuration->getBrandAttributeCode();

        if (!$brandAttributeCode) {
            return null;
        }

        $product = $this->getProduct();

        if (empty($product)) {
            return null;
        }

        return (string)$product->getAttributeText($brandAttributeCode) ?: $product->getData($brandAttributeCode);
    }

    protected function getProduct()
    {
        return $this->registry->registry('product');
    }
}
