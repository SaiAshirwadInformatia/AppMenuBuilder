<?php
/**
 *  PHP Config Factory
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu\Factory;

use saiashirwadinformatia\AppMenuBuilder\Menu\ItemList;

class PHPConfigFactory extends MenuFactory implements MenuFactoryInterface
{

    /**
     * @param $config
     */
    public function build($config, $base_url = '')
    {
        if (is_string($config) && !file_exists($config)) {
            throw new \InvalidArgumentException('Config file (' . $config . ') not found');
        }
        if($base_url){
            $this->base_url = $base_url;
        }
        $itemList = new ItemList();
        if(is_string($config)){
            $menuList = include $config;
        }else{
            $menuList = $config;
        }
        foreach ($menuList as $menuKey => $menuArr) {
            $this->addItem($menuKey, $menuArr, $itemList);
        }
        return $itemList;
    }
}
