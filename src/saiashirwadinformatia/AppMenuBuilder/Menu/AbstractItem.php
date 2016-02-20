<?php
/**
 *  Abstract Item
 *
 *  @author Rohan Sakhale <rs@saiashirwad.com>
 */
namespace saiashirwadinformatia\AppMenuBuilder\Menu;

abstract class AbstractItem implements ItemInterface
{

    protected $key;

    protected $label;

    protected $url;

    protected $icon;

    protected $permission;

    protected $children;

    public function __construct($key, $label, $url, $icon = null, $permission = null, AbstractMenuList $children = null)
    {
        $this->key = $key;
        $this->label = $label;
        $this->url = $url;
        $this->icon = $icon;
        $this->permission = $permission;
        $this->children = $children;
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        if ($key) {
            $this->key = $key;
        }
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $label
     */
    public function setLabel($label)
    {
        if ($label) {
            $this->label = $label;
        }
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        if ($url) {
            $this->url = $url;
        }
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $icon
     */
    public function setIcon($icon)
    {
        if ($icon) {
            $this->icon = $icon;
        }
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param $permission
     */
    public function setPermission($permission)
    {
        if ($permission) {
            $this->permission = $permission;
        }
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param $key
     * @param $label
     * @param $url
     * @param $icon
     * @param null             $permission
     * @param AbstractMenuList $children
     */
    abstract public function addChild($key, $label, $url,
        $icon = null, $permission = null, AbstractMenuList $children = null);

    /**
     * @param $key
     * @param ItemInterface $item
     */
    abstract public function addChildObject($key, ItemInterface $item);

    /**
     * @param AbstractMenuList $children
     */
    public function addChildren(AbstractMenuList $children)
    {
        if ($children) {
            $this->children = $children;
        }
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return mixed
     */
    abstract public function getIconHTML();

    /**
     * @return mixed
     */
    public function hasChildren()
    {
        return $this->children && $this->children->size() > 0;
    }

    /**
     * @param $currentUrl
     */
    public function isActive($currentUrl)
    {
        return $this->url && $this->url !== '#'
        && $this->url === $currentUrl;
    }
}
