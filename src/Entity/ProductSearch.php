<?php


namespace App\Entity;


class ProductSearch
{
    /**
     * @var int|null
     */
    private $maxprice;

    /**
     * @var int|null
     */
    private $minprice;

    /**
     * @return int|null
     */
    public function getMaxprice(): ?int
    {
        return $this->maxprice;
    }

    /**
     * @return int|null
     */
    public function getMinprice(): ?int
    {
        return $this->minprice;
    }

    /**
     * @param int|null $maxprice
     */
    public function setMaxprice(?int $maxprice): void
    {
        $this->maxprice = $maxprice;
    }

    /**
     * @param int|null $minprice
     */
    public function setMinprice(?int $minprice): void
    {
        $this->minprice = $minprice;
    }
}