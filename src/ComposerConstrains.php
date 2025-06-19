<?php
// defined namespace
namespace lexriri\ComposerConstrains;

require_once __DIR__."./vendor/autoload.php";
//library
use PHPExperts\ComposerVersionConstraints\ComposerConstraintsHelper;

//class
class ComposerConstrains extends PHPUnit\Framework\TestCase
{
    private ComposerConstraintsHelper $help;

    private function _construct()
    {
        $this->help = new ComposerConstraintsHelper();
    }

    public function TestBasicFunc()
    {
        self::markTestSkipped('dev');
        $this->assertTrue($this->help->versionSatisfies('1.0.0'));
        $this->assertTrue($this->help->versionSatisfies('v1.0.0'));
        $this->assertFalse($this->help->versionSatisfies('1.0'));
        $this->assertFalse($this->help->versionSatisfies('1.a.0'));
    }
    public function TestCaretFunc()
    {
        self::markTestSkipped('dev');

        $this->assertTrue($this->help->versionSatisfies('^1.0.0'));
        $this->assertTrue($this->help->versionSatisfies('^0.5.0'));
        $this->assertFalse($this->help->versionSatisfies('^1.0'));
        $this->assertFalse($this->help->versionSatisfies('^1.0.0.0'));

    }
    public function  TestTildeConstraintFunc()
    {
         self::markTestSkipped('dev');

         $this->assertTrue($this->help->versionSatisfies('~1.2.3'));
         $this->assertTrue($this->help->versionSatisfies('~1.2.0'));
         $this->assertFalse($this->help->versionSatisfies('~1.2'));
         $this->assertFalse($this->help->versionSatisfies('~1'));
    }

    public function TestVersionChanges()
    {
        self::markTestSkipped('dev');

         $this->assertTrue($this->help->versionSatisfies('1.0.0 - 2.0.0'));
          $this->assertTrue($this->help->versionSatisfies('>=1.0.0 <2.0.0'));
          $this->assertFalse($this->help->versionSatisfies('1.0.0 - 2.0'));
          $this->assertFalse($this->help->versionSatisfies('1.0 - 2.0'));

    }

    public function TestWildcardConstraints()
    {
        self::markTestSkipped('dev');

        $this->assertTrue($this->help->versionSatisfies('1.0.*'));
        $this->assertTrue($this->help->versionSatisfies('1.*'));
        $this->assertTrue($this->help->versionSatisfies('1.x'));
        $this->assertFalse($this->help->versionSatisfies('1.*.0'));
        $this->assertFalse($this->help->versionSatisfies('*.0.0'));
    }

    public function TestOrVersionCondition()
    {
        self::markTestSkipped('dev');

        $this->assertTrue($this->help->versionSatisfies('^1.0 || ^2.0'));
        $this->assertTrue($this->help->versionSatisfies('~1.2.3 || >=2.0.0'));
        $this->assertFalse($this->help->versionSatisfies('^1.0   || 2.0'));
        $this->assertFalse($this->help->versionSatisfies('||'));
        
    }
    public function TestAndVesionCondition()
    {
        self::markTestSkipped('dev');

         $this->assertTrue($this->help->versionSatisfies('^1.0.0  ^2.0.0'));
        $this->assertTrue($this->help->versionSatisfies('>=1.0.0 <1.1.1 || >=1.2.0'));
        $this->assertFalse($this->help->versionSatisfies('^1.0  2.0'));
        $this->assertFalse($this->help->versionSatisfies(' '));
    }

    public function TestNormalize()
    {
         self::markTestSkipped('dev');

         $this->assertEquals('1.0.0'.$this->help->normalizeConstraints());
    }

}

?>