<?php
/**
 * In this file the exception class '\UK\CoreException' is defined.
 *
 * @author         UniKado <unikado+pubcode@protonmail.com>
 * @copyright  (c) 2016, UniKado
 * @package        UK
 * @since          2016-06-24
 * @subpackage     Errors
 * @version        0.1.0
 */


declare( strict_types = 1 );


namespace UK;


/**
 * <b>ATTENTION!</b> Never throw or use this exception inside your code!
 *
 * @since v0.1.0
 */
class CoreException extends \Exception
{


   // <editor-fold desc="// = = = =   P U B L I C   S T A T I C   F I E L D S   = = = = = = = = = = = = = = = = = = =">

   /**
    * If this value is set to true Notices will trigger an exception
    *
    * @type bool
    */
   public static $debug = false;

   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   C O N S T R U C T O R   = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Init's a new instance.
    *
    * @param string     $message  The error message
    * @param int        $code     The optional error code. (defaults to \E_ERROR)
    * @param \Exception $previous Optional previous exception.
    */
   public function __construct( string $message, int $code = \E_ERROR, \Exception $previous = null )
   {

      // Call the parent constructor (\Exception)
      parent::__construct(
         $message,
         $code,
         $previous
      );

   }

   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   M E T H O D S   = = = = = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Extends the origin getMessage method, so also previous messages are include, if defined.
    *
    * @param  bool $appendPreviousByNewline If a prev. Exception is defined append it by a new line? (' ' other)
    * @return string
    */
   public function getErrorMessage( bool $appendPreviousByNewline = false ) : string
   {

      // Getting a optional previous exception
      $prev = $this->getPrevious();

      if ( \is_null( $prev ) )
      {
         // If no previous exception is used
         return \sprintf(
            '%s(%d): %s',
            static::GetCodeName( $this->getCode() ),
            $this->getCode(),
            $this->getMessage()
         );
      }

      // Define the separator between current and previous exception.
      $separator = $appendPreviousByNewline ? "\n" : ' ';

      if ( ( $prev instanceof CoreException ) )
      {
         return \sprintf(
            '%s(%d): %s%s%s',
            static::GetCodeName( $this->getCode() ),
            $this->getCode(),
            $this->getMessage(),
            $separator,
            $prev->getErrorMessage( $appendPreviousByNewline )
         );
      }

      return \sprintf(
         '%s(%d): %s%s%s',
         static::GetCodeName( $this->getCode() ),
         $this->getCode(),
         $this->getMessage(),
         $separator,
         $prev->getMessage()
      );

   }

   /**
    * Overrides __toString, to return a more detailed string, when object is casted to a string.
    *
    * @return string
    */
   public final function __toString()
   {

      return $this->toCustomString();

   }

   /**
    * Allows the definition of the sub exception level if there is a parent exception that contains this exception.
    *
    * @param  int     $subExceptionLevel
    * @param  string  $indentSpaces      Spaces to use for a single indention level.
    * @return string
    */
   public function toCustomString( int $subExceptionLevel = 0, string $indentSpaces = '   ' ) : string
   {

      // Concatenate the base error message from usable elements
      $msg = \sprintf(
         "%s%s in %s[%d]. %s",
         \str_repeat( $indentSpaces, $subExceptionLevel ),
         \get_class( $this ),
         $this->file,
         $this->line,
         \str_replace( "\n", "\n" . \str_repeat( $indentSpaces, $subExceptionLevel ), $this->message )
      );

      // getting a may defined previous exception
      $previous = $this->getPrevious();

      // if no previous exception is defined return the current generated message
      if ( \is_null( $previous ) || ! ( $previous instanceof \Exception ) )
      {
         return $msg;
      }

      // If previous message is a framework internal exception
      if ( $previous instanceof CoreException )
      {

         // Simple cast the exception to a string and append it with rewrite the indention
         $msg .= "\n" . $previous->toCustomString( $subExceptionLevel + 1, $indentSpaces );

         // And return the message
         return $msg;

      }

      // Else its a normal PHP exception

      // Concatenate the previous error message from usable elements
      $msg .= \sprintf(
         "\n%s%s %s in %s[%d]\n    %s",
         \str_repeat( $indentSpaces, $subExceptionLevel + 1 ),
         \get_class( $previous ),
         static::GetCodeName( $previous->getCode() ),
         $previous->file,
         $previous->line,
         \str_replace( "\n", "\n" . \str_repeat( $indentSpaces, $subExceptionLevel + 1 ), $previous->message )
      );

      // And return the message
      return $msg;

   }

   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   S T A T I C   M E T H O D S   = = = = = = = = = = = = = = = = = =">

   /**
    * Returns a string, representing the defined error code.
    *
    * @param  int $code e.g.: \E_USER_ERROR
    * @return string
    */
   public static function GetCodeName( int $code ) : string
   {

      switch ( $code )
      {

         case \E_ERROR:
         case \E_USER_ERROR:
            return 'ERROR';

         case \E_WARNING:
         case \E_USER_WARNING:
            return 'WARNING';

         case \E_DEPRECATED:
         case \E_USER_DEPRECATED:
            return 'DEPRECATED';

         case \E_NOTICE:
         case \E_USER_NOTICE:
            return 'NOTICE';

         case \E_PARSE:
            return 'PARSE';
         case \E_RECOVERABLE_ERROR:
            return 'RECOVERABLE ERROR';

         case \E_STRICT:
            return 'STRICT';

         default:
            return 'OTHER';

      }

   }
   
   // </editor-fold>


}

