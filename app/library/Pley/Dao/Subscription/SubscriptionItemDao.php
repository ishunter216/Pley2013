<?php
namespace Pley\Dao\Subscription;

use \Pley\Dao\AbstractDbDao;
use \Pley\Dao\CacheDaoInterface;
use \Pley\Dao\DaoInterface;
use \Pley\Dao\DbDaoInterface;
use \Pley\Dao\Traits\CacheDaoTrait;
use \Pley\Entity\Subscription\SubscriptionItem;

/** ♰
 * The <kbd>SubscriptionItemDao</kbd> class provides implementation to interact with the SubscriptionItem
 * table in the DB and Cache.
 *
 * @author Arsen Sargsyan
 * @version 1.0
 * @package Pley.Dao.Subscription
 * @subpackage Dao
 */
class SubscriptionItemDao extends AbstractDbDao implements DaoInterface, DbDaoInterface, CacheDaoInterface
{
    use CacheDaoTrait; // Provides implementation for CacheDaoInterface

    /** @var string */
    protected $_tableName = 'subscription_item';
    /**
     * The string list of escaped column names to retrieve data for the table controlled by this DAO
     * @var string
     */
    protected $_columnNames;
    
    public function __construct()
    {
        $escapedColumnNames = $this->_escapedFields([
            'id', 'subscription_id', 'item_id',
        ]);
        
        $this->_columnNames = implode(',', $escapedColumnNames);
    }


    /**
     * Map an associative array DB record into a <kbd>SubscriptionItem</kbd> Entity.
     * 
     * @param array $dbRecord
     * @return \Pley\Entity\Subscription\SubscriptionItem
     */
    protected function _toEntity($dbRecord)
    {
        if (empty($dbRecord)) {
            return null;
        }
        
        return new SubscriptionItem(
            $dbRecord['id'], 
            $dbRecord['subscription_id'],
            $dbRecord['item_id']
        );
    }

    public function _insert(SubscriptionItem $subscriptionItem)
    {
        $prepSql = "INSERT INTO `{$this->_tableName}` ("
            . '`subscription_id`,'
            . '`item_id`'
            . ") VALUES (?,?);";
        $pstmt = $this->_prepare($prepSql);
        $bindings = [
            $subscriptionItem->getSubscriptionId(),
            $subscriptionItem->getItemId(),
        ];
        $pstmt->execute($bindings);
        $id = $this->_dbManager->lastInsertedId();
        $pstmt->closeCursor();
        $subscriptionItem->setId($id);
    }

       /**
        * Return the <kbd>ItemPart</kbd> entity for the supplied id or null if not found.
        * @param int $id
        * @return \Pley\Entity\Subscription\ItemPart
        */
       public function find($id)
       {
           // Reading from cache first
           if ($this->_cache->has($id)) {
               return $this->_cache->get($id);
           }

           $prepSql  = "SELECT {$this->_columnNames} FROM `{$this->_tableName}` "
                     . "WHERE `id` = ?";
           $pstmt    = $this->_prepare($prepSql);
           $bindings = [$id];

           $pstmt->execute($bindings);

           $dbRecord = $pstmt->fetch(\PDO::FETCH_ASSOC);
           $pstmt->closeCursor();
           $entity = $this->_toEntity($dbRecord);

           // Now that we have retrieved the Entity, let's add it to the cache
           $this->_cache->set($id, $entity);

           return $entity;
       }
}
