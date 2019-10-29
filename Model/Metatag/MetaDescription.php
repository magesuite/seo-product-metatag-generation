<?php

namespace MageSuite\SeoProductMetatagGeneration\Model\Metatag;

class MetaDescription implements MetatagInterface
{
    const METATAG_KEY = 'meta_description';

    /**
     * @var \MageSuite\SeoProductMetatagGeneration\Helper\Configuration
     */
    protected $configuration;

    /**
     * @var \MageSuite\DynamicDirectives\Service\DirectiveApplier
     */
    protected $directiveApplier;

    public function __construct(
        \MageSuite\SeoProductMetatagGeneration\Helper\Configuration $configuration,
        \MageSuite\DynamicDirectives\Service\DirectiveApplier $directiveApplier
    ) {
        $this->configuration = $configuration;
        $this->directiveApplier = $directiveApplier;
    }

    public function isApplicable($key)
    {
        return $key == self::METATAG_KEY;
    }

    public function getText()
    {
        $metaDescription = $this->configuration->getMetaDescription();

        if (empty($metaDescription)) {
            return null;
        }

        return $this->directiveApplier->apply($metaDescription);
    }
}
