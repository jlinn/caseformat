<?php
/**
 * User: Joe Linn
 * Date: 2/20/14
 * Time: 1:43 PM
 */

namespace CaseFormat;


class CaseFormat {
    const LOWER_HYPHEN = 'lower_hyphen';            // foo-bar
    const LOWER_UNDERSCORE = 'lower_underscore';    // foo_bar
    const LOWER_CAMEL = 'lower_camel';              // fooBar
    const UPPER_CAMEL = 'upper_camel';              // FooBar
    const UPPER_UNDERSCORE = 'upper_underscore';    // FOO_BAR

    /**
     * A string in LOWER_UNDERSCORE format
     * @var string
     */
    protected $string;

    /**
     * @param string $lowerUnderscore a string in UPPER_CAMEL format
     */
    public function __construct($lowerUnderscore){
        $this->string = $lowerUnderscore;
    }

    /**
     * @param $string
     * @return static
     */
    public static function LOWER_HYPHEN($string){
        $formatted = '';
        foreach(explode('-', $string) as $part){
            $formatted .= ucfirst($part);
        }
        return new static($formatted);
    }

    /**
     * @param string $string
     * @return static
     */
    public static function LOWER_UNDERSCORE($string){
        $formatted = '';
        foreach(explode('_', $string) as $part){
            $formatted .= ucfirst($part);
        }
        return new static($formatted);
    }

    /**
     * @param $string
     * @return static
     */
    public static function LOWER_CAMEL($string){
        return new static(ucfirst($string));
    }

    /**
     * @param $string
     * @return static
     */
    public static function UPPER_CAMEL($string){
        return new static($string);
    }

    /**
     * @param $string
     * @return static
     */
    public static function UPPER_UNDERSCORE($string){
        $formatted = '';
        foreach(explode('_', $string) as $part){
            $formatted .= ucfirst(strtolower($part));
        }
        return new static($formatted);
    }

    /**
     * Convert the currently stored UPPER_CAMEL formatted string to the given format
     * @param string $format see class constants for valid output formats
     * @throws \InvalidArgumentException when an invalid format is provided
     * @return string
     */
    public function to($format){
        switch($format){
            case self::LOWER_HYPHEN:
                return strtolower($this->explodeOnCapsAndImplode('-', $this->string));
                break;

            case self::LOWER_UNDERSCORE:
                return strtolower($this->explodeOnCapsAndImplode('_', $this->string));
                break;

            case self::LOWER_CAMEL:
                return lcfirst($this->string);
                break;

            case self::UPPER_UNDERSCORE:
                return strtoupper($this->explodeOnCapsAndImplode('_', $this->string));
                break;

            case self::UPPER_CAMEL:
                return $this->string;
                break;

            default:
                throw new \InvalidArgumentException("'{$format}' is not a valid conversion format.");
        }
    }

    /**
     * Explode a string when capital letters are encountered.
     * "FooBar" becomes array("Foo", "Bar")
     * @param string $string
     * @return array
     */
    protected function explodeOnCaps($string){
        return preg_split('/(?=[A-Z])/', $string);
    }

    /**
     * Explode a string on capital letters, then implode using the given glue
     * @param string $glue
     * @param string $string
     * @return string
     */
    protected function explodeOnCapsAndImplode($glue, $string){
        return implode($glue, array_slice($this->explodeOnCaps($string), 1));
    }
} 