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
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoDataFixture loadProducts
     * @magentoConfigFixture current_store seo/product_metatag_generation/is_enabled 1
     * @magentoConfigFixture current_store seo/product_metatag_generation/meta_title Meta Title {{product_name}}
     * @magentoConfigFixture current_store seo/product_metatag_generation/meta_description Meta Description {{product_name}}
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
            ['product_without_metatags', 'Meta Title Product without meta tags', 'Meta Description Product without meta tags'],
            ['product_with_metatags', 'Meta title text', 'Meta description text']
        ];
    }

    public static function loadProducts()
    {
        require __DIR__.'/../_files/products.php';
    }

    public static function loadProductsRollback()
    {
        require __DIR__.'/../_files/products_rollback.php';
    }
}
