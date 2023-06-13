<?php

declare(strict_types=1);

namespace Magebit\MagebitProductPage\Block\Product\View;

use Magento\Catalog\Block\Product\View\Attributes as OriginalAttributes;

class Attributes extends OriginalAttributes
{
    public function getAttributeList(): array {
        $attributes = [];
        die;
        $product = $this->getProduct();
        var_dump($product);
        die;
        echo "This is a test!";
        $attributes = [
          'color' => $product->getData('color')
        ];
        var_dump($attributes);
        die;

        return $attributes;
    }
}
