<?php

namespace albertborsos\ddd\tests\unit\models;

use albertborsos\ddd\interfaces\EntityInterface;
use albertborsos\ddd\tests\support\base\domains\customer\entities\Customer;
use albertborsos\ddd\tests\support\base\domains\customer\entities\CustomerAddress;
use albertborsos\ddd\tests\support\base\MockTrait;
use albertborsos\ddd\tests\support\base\services\customer\forms\CreateCustomerForm;
use Codeception\PHPUnit\TestCase;
use yii\base\DynamicModel;

class AbstractEntityTest extends TestCase
{
    use MockTrait;

    public function dataProviderSetPrimaryKey()
    {
        return array_merge(
            $this->dataProviderInvalidPrimaryKeys(),
            $this->dataProviderValidPrimaryKeys()
        );
    }

    public function dataProviderInvalidPrimaryKeys()
    {
        return [
            'no primary key (null)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => null]],
            'no primary key (empty string)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => '']],
            'no primary key (array with empty string)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => ['']]],
            'no primary key (array with null value)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => [null]]],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderValidPrimaryKeys(): array
    {
        return [
            'standard primary key (string)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => 'id']],
            'standard primary key (array)' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => ['id']]],
            'composite key' => [['id' => 1, 'name' => 'Name'], Customer::class, ['getPrimaryKey' => ['id', 'name']]],
        ];
    }

    /**
     * @dataProvider dataProviderSetPrimaryKey
     */
    public function testSetPrimaryKey($modelAttributes, $entityClass, $entitySettings)
    {
        $model = new DynamicModel($modelAttributes);

        /** @var EntityInterface $entity */
        $entity = $this->mockObject(['class' => $entityClass, 'settings' => $entitySettings]);

        $entity->setPrimaryKey($model);

        foreach ($entity->attributes as $attribute => $value) {
            $isPrimaryKey = in_array($attribute, is_array($entity->getPrimaryKey()) ? $entity->getPrimaryKey() : [$entity->getPrimaryKey()]);
            $this->assertEquals($isPrimaryKey ? $value : null, $entity->$attribute);
        }
    }

    /**
     * @dataProvider dataProviderInvalidPrimaryKeys
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testCacheKeyWithInvalidPrimaryKeysWillThrowsException($modelAttributes, $entityClass, $entitySettings)
    {
        $model = new DynamicModel($modelAttributes);
        /** @var EntityInterface $entity */
        $entity = $this->mockObject(['class' => $entityClass, 'settings' => $entitySettings]);
        $entity->setPrimaryKey($model);

        $entity->getCacheKey();
    }

    /**
     * @dataProvider dataProviderValidPrimaryKeys
     */
    public function testCacheKey($modelAttributes, $entityClass, $entitySettings)
    {
        $model = new DynamicModel($modelAttributes);
        /** @var EntityInterface $entity */
        $entity = $this->mockObject(['class' => $entityClass, 'settings' => $entitySettings]);
        $entity->setPrimaryKey($model);

        $this->assertNotEmpty($entity->getCacheKey());
        $this->assertNotEquals($entity->getCacheKey(), get_class($entity));
    }

    public function dataProviderDataAttributes()
    {
        return [
            'Customer Entity' => [Customer::class, [], array_fill_keys(['id', 'name'], null)],
            'CustomerAddress Entity' => [CustomerAddress::class, [], array_fill_keys(['id', 'customer_id', 'zip_code', 'city', 'street'], null)],
            'Customer Form with custom property' => [CreateCustomerForm::class, [], array_fill_keys(['id', 'name'], null)],
        ];
    }

    /**
     * @dataProvider dataProviderDataAttributes
     *
     * @param $entityClass
     * @param $entitySettings
     * @param $expectedDataAttributes
     */
    public function testGetDataAttributes($entityClass, $entitySettings, $expectedDataAttributes)
    {
        /** @var EntityInterface $entity */
        $entity = $this->mockObject(['class' => $entityClass, 'settings' => $entitySettings]);

        $this->assertEquals($expectedDataAttributes, $entity->getDataAttributes());
    }

    /**
     * @return array
     */
    public function dataProviderFieldMapping()
    {
        return [
            'standard fields' => [Customer::class, [], ['id' => 'id', 'name' => 'name', 'customerAddresses' => 'customerAddresses']],
            'fields with snake_case' => [CustomerAddress::class, [], ['id' => 'id', 'customer_id' => 'customerId', 'zip_code' => 'zipCode', 'city' => 'city', 'street' => 'street', 'customer' => 'customer']],
        ];
    }

    /**
     * @dataProvider dataProviderFieldMapping
     *
     * @param $entityClass
     * @param $entitySettings
     * @param $expectedDataAttributes
     */
    public function testFieldmapping($entityClass, $entitySettings, $expectedMapping)
    {
        /** @var EntityInterface $entity */
        $entity = $this->mockObject(['class' => $entityClass, 'settings' => $entitySettings]);

        $this->assertEquals($expectedMapping, $entity->fieldMapping());
    }
}