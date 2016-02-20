<?php
/**
 *  Admin LTE Menu Builder
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu\Builder;

use saiashirwadinformatia\AppMenuBuilder\Menu\AbstractMenuList;

abstract class AbstractBuilder
{
    public $menuClass;

    public $parentClass;

    public $childClass;

    public $activeClass;

    public $currentUrl;

    public function __construct($currentUrl = '', $menuClass = '', $parentClass = '', $childClass = '', $activeClass = '')
    {
        $this->currentUrl = $currentUrl;
        $this->menuClass = $menuClass;
        $this->parentClass = $parentClass;
        $this->childClass = $childClass;
        $this->activeClass = $activeClass;
    }

    /**
     * @param AbstractMenuList $items
     * @param $currentUrl
     * @param $menuClass
     * @param $parentClass
     * @param $childClass
     * @param $activeClass
     */
    public function build(AbstractMenuList $items, $currentUrl = '', $menuClass = '', $parentClass = '', $childClass = '', $activeClass = '')
    {
        if ($currentUrl) {
            $this->currentUrl = $currentUrl;
        }
        if ($menuClass) {
            $this->menuClass = $menuClass;
        }
        if ($parentClass) {
            $this->parentClass = $parentClass;
        }
        if ($childClass) {
            $this->childClass = $childClass;
        }
        if ($activeClass) {
            $this->activeClass = $activeClass;
        }
        return '<ul class="' . $this->menuClass . '">' . $this->buildMenu($items) . '</ul>';
    }

    /**
     * @param AbstractMenuList $items
     */
    abstract public function buildMenu(AbstractMenuList $items);
}
