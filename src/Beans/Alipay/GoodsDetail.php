<?php

namespace EasySwoole\Pay\Beans\Alipay;


class GoodsDetail extends BaseBean
{
    public string $goods_id;

    public string $goods_name;

    public int $quantity;

    public int $price;


    public string $goods_category;

    public string $categories_tree;

    public string $show_url;

    public function getGoodsId(): string
    {
        return $this->goods_id;
    }

    public function setGoodsId(string $goods_id): void
    {
        $this->goods_id = $goods_id;
    }

    public function getGoodsName(): string
    {
        return $this->goods_name;
    }

    public function setGoodsName(string $goods_name): void
    {
        $this->goods_name = $goods_name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getGoodsCategory(): string
    {
        return $this->goods_category;
    }

    public function setGoodsCategory(string $goods_category): void
    {
        $this->goods_category = $goods_category;
    }

    public function getCategoriesTree(): string
    {
        return $this->categories_tree;
    }

    public function setCategoriesTree(string $categories_tree): void
    {
        $this->categories_tree = $categories_tree;
    }

    public function getShowUrl(): string
    {
        return $this->show_url;
    }

    public function setShowUrl(string $show_url): void
    {
        $this->show_url = $show_url;
    }

}