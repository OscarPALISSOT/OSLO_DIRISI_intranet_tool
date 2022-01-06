<?php

namespace ContainerBOpdxxc;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder52e0e = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer98ac9 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties9821b = [
        
    ];

    public function getConnection()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getConnection', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getMetadataFactory', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getExpressionBuilder', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'beginTransaction', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getCache', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getCache();
    }

    public function transactional($func)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'transactional', array('func' => $func), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'wrapInTransaction', array('func' => $func), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'commit', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->commit();
    }

    public function rollback()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'rollback', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getClassMetadata', array('className' => $className), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'createQuery', array('dql' => $dql), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'createNamedQuery', array('name' => $name), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'createQueryBuilder', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'flush', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'clear', array('entityName' => $entityName), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->clear($entityName);
    }

    public function close()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'close', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->close();
    }

    public function persist($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'persist', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'remove', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'refresh', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'detach', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'merge', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getRepository', array('entityName' => $entityName), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'contains', array('entity' => $entity), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getEventManager', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getConfiguration', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'isOpen', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getUnitOfWork', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getProxyFactory', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'initializeObject', array('obj' => $obj), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'getFilters', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'isFiltersStateClean', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'hasFilters', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return $this->valueHolder52e0e->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer98ac9 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolder52e0e) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder52e0e = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder52e0e->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__get', ['name' => $name], $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        if (isset(self::$publicProperties9821b[$name])) {
            return $this->valueHolder52e0e->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder52e0e;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder52e0e;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder52e0e;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder52e0e;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__isset', array('name' => $name), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder52e0e;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder52e0e;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__unset', array('name' => $name), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder52e0e;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder52e0e;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__clone', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        $this->valueHolder52e0e = clone $this->valueHolder52e0e;
    }

    public function __sleep()
    {
        $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, '__sleep', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;

        return array('valueHolder52e0e');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer98ac9 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer98ac9;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer98ac9 && ($this->initializer98ac9->__invoke($valueHolder52e0e, $this, 'initializeProxy', array(), $this->initializer98ac9) || 1) && $this->valueHolder52e0e = $valueHolder52e0e;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder52e0e;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder52e0e;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
