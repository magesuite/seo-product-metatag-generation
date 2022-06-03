<?php

namespace MageSuite\SeoProductMetatagGeneration\Test\Integration\Model;

/**
 * @magentoDbIsolation enabled
 * @magentoAppIsolation enabled
 */
class ProductTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    public function setUp(): void
    {
        $objectManager = \Magento\TestFramework\ObjectManager::getInstance();
        $this->registry = $objectManager->get(\Magento\Framework\Registry::class);
        $this->productRepository = $objectManager->create(\Magento\Catalog\Api\ProductRepositoryInterface::class);
    }

    /**
     * @magentoAppArea frontend
     * @magentoDataFixture MageSuite_SeoProductMetatagGeneration::Test/Integration/_files/products.php
     * @magentoConfigFixture current_store seo/product_metatag_generation/is_enabled 1
     * @magentoConfigFixture current_store seo/product_metatag_generation/meta_title Meta Title - {{product_name}} - {{product_brand}}
     * @magentoConfigFixture current_store seo/product_metatag_generation/meta_description Meta Description - {{product_short_description}}
     * @magentoConfigFixture current_store seo/product_metatag_generation/brand description
     * @dataProvider dataProvider
     * @param integer $productId
     * @param string $expectedMetaTitle
     * @param string $expectedMetaDescription
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function testItReturnsCorrectAttributeValue($productId, $expectedMetaTitle, $expectedMetaDescription)
    {
        $product = $this->productRepository->get($productId);

        if ($this->registry->registry('product')) {
            $this->registry->unregister('product');
        }
        $this->registry->register('product', $product);

        $this->assertEquals($expectedMetaTitle, $product->getMetaTitle());
        $this->assertEquals($expectedMetaDescription, $product->getMetaDescription());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['product_without_metatags', 'Meta Title - Product without meta tags - Description', 'Meta Description - Short Description'],
            ['product_with_metatags', 'Meta title text', 'Meta description text']
        ];
    }
}
