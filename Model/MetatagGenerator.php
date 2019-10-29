<?php

namespace MageSuite\SeoProductMetatagGeneration\Model;

class MetatagGenerator
{
    /**
     * @var \MageSuite\SeoProductMetatagGeneration\Model\MetatagPool
     */
    protected $metatagPool;

    public function __construct(\MageSuite\SeoProductMetatagGeneration\Model\MetatagPool $metatagPool)
    {
        $this->metatagPool = $metatagPool;
    }

    public function generate($key)
    {
        /** @var \MageSuite\SeoProductMetatagGeneration\Model\Metatag\MetatagInterface $metatag */
        $metatag = $this->metatagPool->getMetatag($key);

        if (empty($metatag)) {
            return null;
        }

        return $metatag->getText();
    }
}
