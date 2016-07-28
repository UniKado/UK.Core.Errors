<?php
/**
 * In this file the exception class '\UK\Core\PhpException' is defined.
 *
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @package        UK
 * @since          2016-06-24
 * @subpackage     Errors
 * @version        0.1.1
 */


declare( strict_types = 1 );


namespace UK;


/**
 * This exception is used by UniKado error handler. It will only be thrown by the error handler, if a
 * catchable error occurs.
 *
 * <b>ATTENTION!</b> Never throw this exception inside your code!
 *
 * @since v0.1.0
 */
class PhpException extends CoreException
{


   // <editor-fold desc="// = = = =   P U B L I C   C O N S T R U C T O R   = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Init's a new instance. Don't use it inside you're code!
    *
    * @param string  $message  The error message.
    * @param integer $code     The error code.
    * @param integer $line     The error line.
    * @param string  $file     The error file.
    */
   public function __construct( string $message, int $code, int $line, string $file )
   {

      // Call the parent constructor
      parent::__construct( \strip_tags( $message ), $code );

      // Setting the error file manually.
      $this->file = $file;

      // Setting the error line manually.
      $this->line = $line;

   }

   // </editor-fold>


}

