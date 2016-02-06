<?php
namespace Bolt\Extension\Ross\URLField\Field;

use Bolt\Extension\Ross\URLField\Value\Url;
use Bolt\Storage\EntityManager;
use Bolt\Storage\Field\Type\FieldTypeBase;
use Bolt\Storage\QuerySet;
use Doctrine\DBAL\Types\Type;

/**
 * This class extends the base field type and looks after serializing and hydrating the field
 * on save and load.
 *
 * @author Ross Riley <riley.ross@gmail.com>
 */
class URLFieldType extends FieldTypeBase
{

    public function persist(QuerySet $queries, $entity, EntityManager $em = null)
    {
        $key = $this->mapping['fieldname'];
        $qb = $queries->getPrimary();
        $value = $entity->get($key);

        if (!$value instanceof Url) {
            $value = Url::fromNative($value);
        }

        $qb->set($key, ':' . $key);
        $qb->setParameter($key, (string)$value);

    }


    public function hydrate($data, $entity)
    {
        $key = $this->mapping['fieldname'];

        $val = isset($data[$key]) ? $data[$key] : null;
        if ($val !== null) {
            $value = Url::fromNative($val);
            $this->set($entity, $value);
        }
    }

    public function getName()
    {
        return 'url';
    }

    public function getStorageType()
    {
        return Type::getType('string');
    }

}
