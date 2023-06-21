<?php

declare(strict_types=1);

namespace Magebit\MagebitProductPage\Block\Product\View;

use Magento\Catalog\Block\Product\View\Attributes as OriginalAttributes;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Attributes extends OriginalAttributes implements ArgumentInterface
{
    /**
     * @param $product
     * @param $attributeKey
     * @return string
     */
    public function getAvailableAttributes($product, $attributeKey): string {
        $attributes = $product->getAttributeText($attributeKey);

        if (gettype($attributes) == 'array') {
            $attributes = implode(', ', $attributes);
        }

        if ($attributes === false) {
            $attributes = 'EMPTY';
        }

        return $attributes;
    }

    /**
     * @param $product
     * @return string
     * Full description text
     * @var string $fullText
     * Pattern to get only the Dimensions attribute
     * @var string $pattern
     * Array with found parts from text based on pattern
     * @var array $matches
     */
    public function getDimensions($product): string {
        $fullText = $product->getData('description');
        $pattern = '/Dimensions:\s(.*?)\.<\/li>/';
        preg_match($pattern, $fullText, $matches);

        if (count($matches) < 1) {
            $dimensions = 'EMPTY';
        }
        else {
            $dimensions = $matches[1];
        }

        return $dimensions;
    }

    /**
     * @param $product
     * @return string
     * Full description text
     * @var string $fullText
     * Pattern to get only the first sentence
     * @var string $pattern
     * Array with found parts from text based on pattern
     * @var array $matches
     */
    public function getDescription($product): string {
        $fullText = $product->getData('description');
        $pattern = '/<p>(.*?[.])/';
        preg_match($pattern, $fullText, $matches);
        $description = $matches[1];

        return $description;
    }

    /**
     * @param $product
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * Array with displayable attribute information about product
     * @var array $attributes
     * Array containing backup attributes to display if the required
     * ones are not available
     * @var array $backupAttributes
     * Array with required attribute parameter key vlaues
     * @var array $toGetAttributes
     * Attribute value
     * @var string $resultValue
     */
    public function getAttributeList($product): array {
        $attributes = [];
        $backupAttributes = $this->getAdditionalData();

        $toGetAttributes = ['color', 'material'];
        foreach ($toGetAttributes as $attribute) {
            $resultValue = $this->getAvailableAttributes($product, $attribute);
            if ($resultValue != 'EMPTY') {
                $attributes = $attributes + [
                    $attribute => array (
                        'label' => $product->getResource()->getAttribute($attribute)->getFrontendLabel(),
                        'value' => $resultValue
                    )
                ];
            }
        }

        $resultValue = $this->getDimensions($product);
        if ($resultValue != 'EMPTY') {
            $attributes = $attributes + [
                'dimensions' => array(
                    'label' => 'Dimensions',
                    'value' => $this->getDimensions($product)
                )];
        }

        $attributes = $attributes + $backupAttributes;

        $attributes = array_slice($attributes, 0, 3);

        return $attributes;
    }
}
