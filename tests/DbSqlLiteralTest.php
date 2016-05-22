<?php

/**
 * Class DbSqlLiteralTest
 *
 * @coversDefaultClass DbSqlLiteral
 */
class DbSqlLiteralTest extends PHPUnit_Framework_TestCase {

  /**
   * @var DbSqlLiteral $object
   */
  protected $object;

  public function setUp() {
    parent::setUp();
    $this->object = DbSqlLiteral::build();
  }

  public function tearDown() {
    unset($this->object);
    parent::tearDown(); // TODO: Change the autogenerated stub
  }

  /**
   * @covers ::__construct
   * @covers ::build
   */
  public function testBuild() {
    $this->assertEquals('DbSqlLiteral', get_class($test = DbSqlLiteral::build(null)));
    unset($test);
  }


  public function dataMaxDataProvider() {
    return array(
      // No field
      array('*', DbSqlLiteral::SQL_LITERAL_ALIAS_NONE, 'MAX(*)'),
      array('*', DbSqlLiteral::SQL_LITERAL_ALIAS_AUTO, 'MAX(*) AS `maxValue`'),
      array('*', 'testAlias', 'MAX(*) AS `testAlias`'),

      // With field
      array('test', DbSqlLiteral::SQL_LITERAL_ALIAS_NONE, 'MAX(`test`)'),
      array('test', DbSqlLiteral::SQL_LITERAL_ALIAS_AUTO, 'MAX(`test`) AS `maxTest`'),
      array('test', 'testAlias', 'MAX(`test`) AS `testAlias`'),

      // Dotted no field
      array('table.*', DbSqlLiteral::SQL_LITERAL_ALIAS_NONE, 'MAX(`table`.*)'),
      array('table.*', DbSqlLiteral::SQL_LITERAL_ALIAS_AUTO, 'MAX(`table`.*) AS `maxTable`'),
      array('table.*', 'testAlias', 'MAX(`table`.*) AS `testAlias`'),

      // Dotted with field
      array('table.test', DbSqlLiteral::SQL_LITERAL_ALIAS_NONE, 'MAX(`table`.`test`)'),
      array('table.test', DbSqlLiteral::SQL_LITERAL_ALIAS_AUTO, 'MAX(`table`.`test`) AS `maxTableTest`'),
      array('table.test', 'testAlias', 'MAX(`table`.`test`) AS `testAlias`'),
    );
  }

  /**
   * @param string      $field
   * @param null|string $alias
   * @param string      $expected
   *
   * @dataProvider dataMaxDataProvider
   * @covers ::buildSingleArgument
   * @covers ::max
   * @covers ::__toString
   */
  public function testMax($field, $alias, $expected) {
//    $this->assertEquals($this->object, invokeMethod($this->object, 'max', array($field, $alias)));
    $this->assertEquals($this->object, $this->object->max($field, $alias));
    $this->assertEquals($expected, $this->object->__toString());
  }

}
