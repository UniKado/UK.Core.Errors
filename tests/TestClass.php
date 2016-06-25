<?php
/**
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @package        UK\Tests;
 * @since          2016-06-25
 * @subpackage     …
 * @version        0.1.0
 */

namespace UK\Tests;


use UK\CoreException;
use UK\Exception;


/**
 * The UK\Tests\TestClass class.
 *
 * @since v0.1.0
 */
class TestClass
{


   public static function throwPhpException()
   {
      // Enable debug mode for handle notices as exceptions
      CoreException::$debug = true;
      // trigger notice with undefined variable
      $foo = $bar + 1;

   }

   public static function throwException()
   {
      CoreException::$debug = false;
      throw new Exception( 'This is an exception test', E_ERROR );
   }

   public static function throwException2()
   {
      throw new Exception( 'Exception test', E_ERROR, new Exception( 'Internal exception.' ) );
   }


}
