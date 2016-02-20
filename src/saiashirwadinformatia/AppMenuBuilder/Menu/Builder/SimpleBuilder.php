<?php
/**
 *  Admin LTE Menu Builder
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu\Builder;

use saiashirwadinformatia\AppMenuBuilder\Menu\AbstractItem;
use saiashirwadinformatia\AppMenuBuilder\Menu\AbstractMenuList;

class SimpleBuilder extends AbstractBuilder implements MenuBuilderInterface
{

    public function __construct($currentUrl = '', $menuClass = '', $parentClass = '', $childClass = '', $activeClass = '')
    {
        parent::__construct($currentUrl, $menuClass, $parentClass, $childClass, $activeClass);
    }

    /**
     * @param  AbstractItem $item
     * @param  $className
     * @return mixed
     */
    private function itemElement(AbstractItem $item, $className = '')
    {
        $html = '<li class="' . $className . '" ><a href="' . $item->getUrl() . '">';
        if ($item->getIcon()) {
            $html .= $item->getIconHTML();
        }
        $html .= "<span> " . $item->getLabel() . "</span>";
        if ($item->hasChildren()) {
            $html .= '<i class="fa fa-angle-left pull-right"></i>';
        }
        $html .= "</a>";
        if ($item->hasChildren()) {
            $html .= '<ul class="' . $this->childClass . '">';
            $html .= $this->buildMenu($item->getChildren());
            $html .= '</ul>';
        }
        $html .= '</li>';
        return $html;
    }

    /**
     * @param  AbstractMenuList $items
     * @return mixed
     */
    public function buildMenu(AbstractMenuList $items)
    {
        $html = '';
        $active = '';
        if (count($items->size()) > 0) {
            $menuList = $items->getMenu();
            foreach ($menuList as $key => $item) {
                if ($item->isActive($this->currentUrl)) {
                    $active = $this->activeClass;
                }else{
                    $active = '';
                }
                if ($item->hasChildren()) {
                    $html .= $this->itemElement($item, $this->parentClass . ' ' . $active);
                } else {
                    if ($item->getLabel()) {
                        $html .= $this->itemElement($item, $active);
                    }
                }
            }
        }
        return $html;
    }
}
