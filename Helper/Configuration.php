<?php

namespace MageSuite\SeoProductMetatagGeneration\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_SEO_PRODUCT_METATAG_GENERATION_IS_ENABLED = 'seo/product_metatag_generation/is_enabled';
    const XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_TITLE = 'seo/product_metatag_generation/meta_title';
    const XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_DESCRIPTION = 'seo/product_metatag_generation/meta_description';
    const XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_BRAND = 'seo/product_metatag_generation/brand';

    public function isEnabled()
    {
        return (bool)$this->scopeConfig->getValue(self::XML_PATH_SEO_PRODUCT_METATAG_GENERATION_IS_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMetaTitle()
    {
        if (!$this->isEnabled()) {
            return null;
        }

        return $this->scopeConfig->getValue(self::XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_TITLE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMetaDescription()
    {
        if (!$this->isEnabled()) {
            return null;
        }

        return $this->scopeConfig->getValue(self::XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_DESCRIPTION, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getBrandAttributeCode()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_SEO_PRODUCT_METATAG_GENERATION_META_BRAND, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
