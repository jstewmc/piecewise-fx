<?php
/**
 * The file for the piecewise-fx tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\PiecewiseFx;

use Jstewmc\Fx\{Equality, Constant};
use Jstewmc\Interval\Interval;
use Jstewmc\TestCase\TestCase;

/**
 * Tests for the piecewise-fx class
 */
class PiecewiseFxTest extends TestCase
{
    /* !__construct() */
    
    /**
     * __construct() should set the fx's properties
     */
    public function testConstruct()
    {
        $subFxs = [new SubFx(new Interval('[0, 1]'), new Equality())];
        
        $fx = new PiecewiseFx($subFxs);
        
        $this->assertSame($subFxs, $this->getProperty('subFxs', $fx));
        
        return;
    }
    
    
    /* !__invoke() */
    
    /**
     * __invoke() should throw exception if $x is not a number
     */
    public function testInvokeThrowsExceptionIfXIsNotNumber()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        (new PiecewiseFx())('foo');
        
        return;
    }
    
    /**
     * __invoke() should return null if subFxs do not exist
     */
    public function testInvokeReturnsNullIfSubFxsDoNotExist()
    {
        return $this->assertNull((new PiecewiseFx())(1));
    }
     
    /**
     * __invoke() should return null if $x is outside sub-function interval
     */
    public function testInvokeReturnsNullIfXIsOutsideInterval()
    {
        $subFxs = [
            new SubFx(new Interval('[0, 2]'), new Equality()),
            new SubFx(new Interval('(2, 4]'), new Equality())
        ];
        
        $fx = new PiecewiseFx($subFxs);
        
        $this->assertNull($fx(999));
        
        return;
    }
    
    
    /**
     * __invoke() should return number if $x is inside sub-function interval
     */
    public function testInvokeReturnsNullIfXIsInsideInterval()
    {
        $subFxs = [
            new SubFx(new Interval('[0, 2]'), new Constant(10)),
            new SubFx(new Interval('(2, 4]'), new Constant(20))
        ];
        
        $fx = new PiecewiseFx($subFxs);
        
        $this->assertEquals(10, $fx(1));
        $this->assertEquals(20, $fx(3));
        
        return;
    }
}
