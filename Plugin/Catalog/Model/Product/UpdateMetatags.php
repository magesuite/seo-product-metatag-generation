<?php

namespace MageSuite\SeoProductMetatagGeneration\Plugin\Catalog\Model\Product;

class UpdateMetatags
{
    /**
     * @var \MageSuite\SeoProductMetatagGeneration\Helper\Configuration
     */
    protected $configuration;

    /**
     * @var \MageSuite\SeoProductMetatagGeneration\Model\MetatagGenerator
     */
    protected $metatagGenerator;

    protected $keys;

    public function __construct(
        \MageSuite\SeoProductMetatagGeneration\Helper\Configuration $configuration,
        \MageSuite\SeoProductMetatagGeneration\Model\MetatagGenerator $metatagGenerator,
        array $keys
    ) {
        $this->configuration = $configuration;
        $this->metatagGenerator = $metatagGenerator;
        $this->keys = $keys;
    }

    public function aroundGetData(\Magento\Catalog\Model\Product $subject, \Closure $proceed, $key = '', $index = null)
    {
        $result = $proceed($key, $index);

        if (!empty($result)) {
            return $result;
        }

        if (!$this->configuration->isEnabled()) {
            return $result;
        }

        if (!in_array($key, $this->keys)) {
            return $result;
        }

        return $this->metatagGenerator->generate($key);
    }
}
