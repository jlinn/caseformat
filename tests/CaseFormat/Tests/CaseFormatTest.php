<?php
/**
 * User: Joe Linn
 * Date: 2/20/14
 * Time: 1:55 PM
 */

namespace CaseFormat\Tests;


use CaseFormat\CaseFormat;

class CaseFormatTest extends \PHPUnit_Framework_TestCase {
    protected $formats = array(
        CaseFormat::LOWER_HYPHEN => 'foo-bar',
        CaseFormat::LOWER_UNDERSCORE => 'foo_bar',
        CaseFormat::LOWER_CAMEL => 'fooBar',
        CaseFormat::LOWER_SPACE => 'foo bar',
        CaseFormat::UPPER_CAMEL => 'FooBar',
        CaseFormat::UPPER_UNDERSCORE => 'FOO_BAR',
        CaseFormat::UPPER_SPACE => 'FOO BAR'
    );

    /**
     * Test conversion to every format from every format.
     */
    public function testConversion(){
        foreach($this->formats as $fromFormat => $input){
            foreach($this->formats as $toFormat => $expected){
                $result = call_user_func('CaseFormat\CaseFormat::'.$fromFormat, $input)->to($toFormat);
                $this->assertEquals($expected, $result);
            }
        }
    }

    public function testInvalidFormat(){
        $this->setExpectedException('InvalidArgumentException');
        CaseFormat::LOWER_UNDERSCORE('foo_bar')->to('blah');
    }
}
 