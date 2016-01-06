<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 05.05.15
 * Time: 14:09
 */

namespace AppBundle\Utils;

use Doctrine\Common\Collections\Collection;

/*
 * Класс предназначен для пагинации коллекции доктрины
 */
class Pagination {
    private $itemsPerPage;
    private $arrayCollection;

    /*
     * Задается коллекция, с которой будет работать класс пагинации (например, значение, возвращаемое полем сущности, отображающим связь -ко-многим)
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /*
     * Задается количество элементов коллекции, отображаемое на одной странице
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /*
     * Метод возвращает количество страниц
     */
    public function getPagesCount()
    {
        $pagesCount = ceil(($this->collection->count()) / $this->itemsPerPage);

        return $pagesCount;
    }

    /*
     *  Метод возвращает элементы коллекции, соответствующие номеру страницы
     */
    public function getItems($page)
    {
        $services = $this->collection->slice(($page - 1) * $this->itemsPerPage, $this->itemsPerPage);

        return $services;
    }
} 