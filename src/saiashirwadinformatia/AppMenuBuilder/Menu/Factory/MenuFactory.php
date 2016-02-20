<?php
/**
 *  Menu Factory
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu\Factory;

use saiashirwadinformatia\AppMenuBuilder\Menu\Item;
use saiashirwadinformatia\AppMenuBuilder\Menu\ItemList;

abstract class MenuFactory
{
    protected $base_url;
    protected $current_url;

    public function __construct($base_url = '', $current_url = '')
    {
        $this->base_url = $base_url;
        $this->current_url = $current_url;
        if ($this->base_url) {
            if (strrpos($this->base_url, '/') !== strlen($this->base_url) - 1) {
                $this->base_url .= '/';
            }
        }
    }

    /**
     * @param $menuKey
     * @param $menuArr
     * @param $itemList
     */
    protected function addItem($menuKey, $menuArr, &$itemList)
    {
        if (!isset($menuArr['label']) || !isset($menuArr['url'])) {
            throw new \Exception('Menu item array element invalid for key: ' . $menuKey);
        }
        $menuArr['url'] = str_replace('#baseurl#', $this->base_url, $menuArr['url']);
        $item = new Item($menuKey, $menuArr['label'], $menuArr['url']);
        $children = new ItemList();
        $item->addChildren($children);
        if (isset($menuArr['icon'])) {
            $item->setIcon($menuArr['icon']);
        }
        if (isset($menuArr['permission'])) {
            $item->setIcon('permission');
        }
        if (isset($menuArr['children'])) {
            foreach ($menuArr['children'] as $childKey => $childArr) {
                $this->addItem($childKey, $childArr, $children);
            }
        }
        $itemList->addObject($menuKey, $item);
    }
}
