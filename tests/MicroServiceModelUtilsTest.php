<?php
/**
 * @file
 * Contains \MicroServiceModelUtilsTest.
 */

use LushDigital\MicroServiceModelUtils\Models\MicroServiceBaseModel;

/**
 * Test the MicroService model utils functionality.
 */
class MicroServiceModelUtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Expected database table name.
     *
     * @var string
     */
    protected $expectedTableName = 'examples';

    /**
     * Expected attribute cache keys.
     *
     * @var array
     */
    protected $expectedAttributeCacheKeys = [];

    /**
     * Expected model cache keys.
     *
     * @var array
     */
    protected $expectedModelCacheKeys = ['examples:index'];

    /**
     * Test the base model functionality.
     *
     * @return void
     */
    public function testBaseModel()
    {
        // Test the table name.
        $this->assertEquals($this->expectedTableName, Example::getTableName());

        // Test the cache keys.
        $model = new Example;
        $this->assertEquals($this->expectedAttributeCacheKeys, $model->getAttributeCacheKeys());

        // Alter the cache keys and test again.
        $this->expectedAttributeCacheKeys = ['name'];
        $model->setAttributeCacheKeys($this->expectedAttributeCacheKeys);
        $this->assertEquals($this->expectedAttributeCacheKeys, $model->getAttributeCacheKeys());
    }

    /**
     * Test the cache handling trait.
     *
     * @return void
     */
    public function testCacheTrait()
    {
        // Test the model cache keys.
        $model = new Example;
        $exampleThing = new AnotherExample;
        $this->assertEquals($this->expectedModelCacheKeys, $exampleThing->getModelCacheKeys($model));

        // Alter the cache keys and test again.
        $this->expectedAttributeCacheKeys = ['name'];
        $this->expectedModelCacheKeys[] = 'examples:name:';
        $model->setAttributeCacheKeys($this->expectedAttributeCacheKeys);
        $this->assertEquals($this->expectedModelCacheKeys, $exampleThing->getModelCacheKeys($model));
    }
}

/**
 * Example model class.
 */
class Example extends MicroServiceBaseModel {}

/**
 * An example class to test the cache handling trait.
 */
class AnotherExample
{
    use \LushDigital\MicroServiceModelUtils\Traits\MicroServiceCacheTrait;
}