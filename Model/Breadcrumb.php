<?php
namespace Btn\BreadcrumbBundle\Model;

class Breadcrumb implements BreadcrumbInterface, BreadcrumbItemInterface, \Iterator
{
    /**
     * Collection of items
     **/
    private $items = array();

    /**
     * Add breadcrumb items from array
     *
     **/
    public function fromArray(array $items)
    {
        foreach ($items as $name => $url) {
            $this->addItem(new BreadcrumbItem($name, $url));
        }
    }

    /**
     * Add breadcrumb item
     *
     **/
    public function addItem(BreadcrumbItemInterface $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Add array of items
     *
     **/
    function setItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Create BreadcrumbItem and save to $items
     *
     **/
    public function createItem($name, $url)
    {
        $this->addItem(new BreadcrumbItem($name, $url));

        return $this;
    }

    /**
     * Create BreadcrumbItem and return
     *
     * @return BreadcrumbItem
     **/
    public function getCreateItem($name, $url)
    {
        return new BreadcrumbItem($name, $url);
    }

    /**
     * Get array of items
     *
     **/
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get first item name
     *
     **/
    public function getName()
    {

        return $this->getFirst()->getName();
    }

    /**
     * Get first item name
     *
     **/
    public function getUrl()
    {
        return $this->getFirst()->getUrl();
    }

    /**
     * Check that has children
     *
     **/
    public function hasChildren($item)
    {
        if ($item instanceof Breadcrumb) {

            return true;
        }

        return false;
    }

    /**
     * Get array of items
     *
     **/
    private function getFirst()
    {
        $items = $this->items;

        return reset($items);
    }

    /**
     * return last element
     */
    public function getLast()
    {
        $items = $this->items;

        return end($items);
    }

    /**
     * Reset iterator
     *
     **/
    function rewind() {
        reset($this->items);
    }

    /**
     * Next item
     *
     **/
    public function next()
    {
        next($this->items);
    }

    /**
     * Current item
     *
     **/
    public function current()
    {
        return current($this->items);
    }

    /**
     * Returns the index element of the current array position
     *
     **/
    public function key()
    {
        return key($this->items);
    }

    /**
     * Check valid current item
     *
     **/
    public function valid()
    {
        return false !== $this->current();
    }

    /**
     * __toString
     *
     **/
    public function __toString() {
        return $this->getName();
    }
}