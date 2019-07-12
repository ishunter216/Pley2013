<?php
namespace Pley\Entity\Subscription;

use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\JsonableInterface;
use Pley\Entity\Jsonable;

/**
 * The <kbd>SubscriptionItem</kbd> entity.
 *
 * @author Arsen Sargsyan
 * @version 1.0
 * @package Pley.Entity.SubscriptionItem
 * @subpackage Entity
 */
class SubscriptionItem implements ArrayableInterface, JsonableInterface
{
    use Jsonable;
    /** @var int */
    protected $_id;
    /** @var int */
    protected $_subscriptionId;
    /** @var int */
    protected $_itemId;

    public function __construct($id, $subscriptionId, $itemId)
    {
        $this->_id                   = $id;
        $this->_subscriptionId       = $subscriptionId;
        $this->_itemId               = $itemId;
    }

    /** @return int */
    public function getId()
    {
        return $this->_id;
    }

    /** @return int */
    public function getSubscriptionId()
    {
        return $this->_subscriptionId;
    }

    /** @return string */
    public function getItemId()
    {
        return $this->_itemId;
    }

    /**
     * Sets the ID for a newly added Item.
     * @param int id
     * @throws \Pley\Exception\Entity\ImmutableAttributeException
     */
    public function setId($id)
    {
        if (isset($this->_id)) {
            throw new \Pley\Exception\Entity\ImmutableAttributeException(static::class, '_id');
        }
        $this->_id = $id;
    }


}
