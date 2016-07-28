<?php
/**
 * In this file the UniKado Core exception class '\UK\Exception' is defined.
 *
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @package        UK
 * @since          2016-04-29
 * @subpackage     Errors
 * @version        0.1.2
 */


declare( strict_types = 1 );


namespace UK;


/**
 * This Exception defines the base functionality for all other Framework exceptions.
 *
 * @since  v0.1
 */
class Exception extends CoreException
{


   # <editor-fold desc="= = =   C O N S T R U C T O R   +   D E S T R U C T O R   = = = = = = = = = = = = = = =">

   /**
    * Init's a new instance.
    *
    * @param string     $message  The error message
    * @param int        $code     The optional Error code (defaults to \E_ERROR)
    * @param \Exception $previous A optional previous exception
    */
   public function __construct( string $message, int $code = \E_ERROR, \Exception $previous = null )
   {

      parent::__construct( $message, $code, $previous );

   }

   # </editor-fold>


   # <editor-fold desc="= = =   P R O T E C T E D   S T A T I C   M E T H O D S   = = = = = = = = = = = = = = =">

   /**
    * Appends a message, if its not empty, separated by ' '.
    *
    * @param  string $message
    * @return string
    */
   protected static function appendMessage( $message ) : string
   {

      return empty( $message ) ? '' : ( ' ' . $message );

   }

   # </editor-fold>


}

