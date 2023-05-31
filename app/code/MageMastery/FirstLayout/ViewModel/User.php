<?php

class ProductViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }
    private $resource;

    public function getProductBySku(string $sku): ProductInterface
    {
        return $this->resource->load($sku, ‘sku’);
    }
}
