<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public string $cardStyle;
    public string $src;
    public string $productId;
    public string $productName;
    public string $price;
    public function __construct($productId, $src, $cardStyle, $price, $productName)
    {
        $this->productId = $productId;
        $this->src = $src;
        $this->cardStyle = $cardStyle;
        $this->price = $price;
        $this->productName = $productName;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
