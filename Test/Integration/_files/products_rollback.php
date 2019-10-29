<?php

$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

$registry = $objectManager->get(\Magento\Framework\Registry::class);

$registry->unregister('isSecureArea');
$registry->register('isSecureArea', true);

$productsIds = [444,445];

foreach ($productsIds as $productsId) {
    $product = $objectManager->create(\Magento\Catalog\Model\Product::class);
    $product->load($productsId);
    if ($product->getId()) {
        $product->delete();
    }
}
