<?php

namespace Core;

class Cart extends Session
{
    CONST HAS_NAMESPACE = TRUE;
    CONST NAMESPACE_ID  = 'Cart';

    public function addItem(\Core\Cart\Item $item, $quantity = 1)
    {
        if ($this->_isSaleable($item)) {
            $items  = $this->getData('items');
            $qtys   = $this->getData('qtys');
            $source = $item->getData('source');
            $key    = get_class($source) . $source->getData($item->getData('id'));

            isset($qtys[$key])
                ? $qtys[$key] = $qtys[$key] + $quantity
                : $qtys[$key] = $quantity;

            $items[$key] = $item;

            $this->setData('items', $items);

            return $this;
        } else {
            return false;
        }
    }

    public function getCartItem($data = [])
    {
        return \Application::getCoreObject('Cart\Item')
            ->addData($data);
    }

    protected function _prepareSession()
    {
        parent::_prepareSession();

        if (!$this->getData('items'))
            $this->setData('items', []);
    }

    protected function _isSaleable(\Core\Cart\Item $item)
    {
        return true;
    }
}
