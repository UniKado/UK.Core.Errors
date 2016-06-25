<?php
/**
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @since          2016-06-25
 * @version        0.1.0
 */


include __DIR__ . '/TestClass.php';
include_once dirname( __DIR__ ) . '/src/UK/errorhandler.php';


use UK\Tests\TestClass;
use UK\CoreException;
use UK\PhpException;


class ExceptionsTest extends PHPUnit_Framework_TestCase
{

   private $pe;


   /**
    * @covers UK\CoreException::__construct
    * @covers UK\CoreException::GetCodeName
    * @covers UK\PhpException::__construct
    * @covers UK\CoreException::getErrorMessage
    * @covers UK\CoreException::__toString
    * @covers UK\CoreException::toCustomString
    * @expectedException UK\CoreException
    * @expectedExceptionMessage Undefined variable: bar
    */
   public function testThrowPhpException1()
   {
      try
      {
         TestClass::throwPhpException();
      }
      catch ( PhpException $ex )
      {
         $this->assertEquals( 'NOTICE(8): Undefined variable: bar', $ex->getErrorMessage(), 'Invalid error message' );
         $this->assertEquals( 'UK\\PhpException in /var/www/html/UK.Core.Errors/tests/TestClass.php[32]. Undefined variable: bar', (string) $ex, 'Invalid toString conversation.' );
         $this->assertEquals( 'UK\\PhpException in /var/www/html/UK.Core.Errors/tests/TestClass.php[32]. Undefined variable: bar', $ex->toCustomString(), 'Invalid toString conversation.' );
         throw $ex;
      }
   }


   /**
    * @covers UK\Exception::__construct
    * @covers UK\PhpException::__construct
    * @covers UK\CoreException::__construct
    * @covers UK\CoreException::GetCodeName
    * @covers UK\CoreException::getErrorMessage
    * @covers UK\CoreException::__toString
    * @covers UK\CoreException::toCustomString
    * @expectedException UK\Exception
    * @expectedExceptionMessage This is an exception test
    */
   public function testThrowUkException()
   {

      try
      {
         TestClass::throwException();
      }
      catch ( CoreException $ex )
      {
         $this->assertEquals( 'ERROR(1): This is an exception test', $ex->getErrorMessage(), 'Invalid error message' );
         $this->assertEquals( 'UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[39]. This is an exception test', (string) $ex, 'Invalid toString conversation.' );
         $this->assertEquals( 'UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[39]. This is an exception test', $ex->toCustomString(), 'Invalid toString conversation.' );
         throw $ex;
      }

   }


   /**
    * @covers UK\Exception::__construct
    * @covers UK\CoreException::__construct
    * @covers UK\CoreException::GetCodeName
    * @covers UK\CoreException::getErrorMessage
    * @covers UK\CoreException::__toString
    * @covers UK\CoreException::toCustomString
    * @expectedException UK\CoreException
    * @expectedExceptionMessage Exception test
    */
   public function testThrowUkException2()
   {

      try
      {
         TestClass::throwException2();
      }
      catch ( CoreException $ex )
      {
         $this->assertEquals( 'ERROR(1): Exception test ERROR(1): Internal exception.', $ex->getErrorMessage(), 'Invalid error message' );
         $this->assertEquals( "UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[44]. Exception test
   UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[44]. Internal exception.", (string) $ex, 'Invalid toString conversation.' );
         $this->assertEquals( "UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[44]. Exception test
   UK\\Exception in /var/www/html/UK.Core.Errors/tests/TestClass.php[44]. Internal exception.", $ex->toCustomString(), 'Invalid toString conversation.' );
         throw $ex;
      }

   }


}

