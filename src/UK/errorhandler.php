<?php
/**
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @since          2016-06-25
 * @version        0.1.1
 */


namespace UK;


/**
 * @access private
 * @internal
 */
function error_handler( $errNo, $errStr, $errFile, $errLine )
{

   switch ( $errNo )
   {

      case \E_NOTICE:
      case \E_USER_NOTICE:
      case \E_STRICT:
         if ( ! CoreException::$debug && ! \defined( 'DEBUG' ) && ! \defined( 'UK_DEBUG' ) )
         {
            // Ignore notices and strict stuff if debug is not enabled
            break;
         }
         throw new \UK\PhpException( $errStr, $errNo, $errLine, $errFile );
         break;

      default:
         throw new \UK\PhpException( $errStr, $errNo, $errLine, $errFile );

   }

}


\set_error_handler( '\\UK\\error_handler' );

