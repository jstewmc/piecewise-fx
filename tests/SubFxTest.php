<?php
/**
 * The file for the sub-function tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\PiecewiseFx;

use Jstewmc\Fx\Equality;
use Jstewmc\Interval\Interval;
use Jstewmc\TestCase\TestCase;

/**
 * Tests for the sub-function class
 */
class SubFxTest extends TestCase
{
    /* !__construct() */
    
    /**
     * __construct() should set the sub-function's properties
     */
    public function testConstruct()
    {
        $interval = new Interval();
        $fx       = new Equality();    
        
        $subFx = new SubFx($interval, $fx);
        
        $this->assertSame($interval, $this->getProperty('interval', $subFx));
        $this->assertSame($fx, $this->getProperty('fx', $subFx));
        
        return;
    }
    
    
    /* !__invoke() */
    
    /**
     * __invoke() should throw exception if $x is not a number
     */
    public function testInvokeThrowsExceptionIfXIsNotNumber()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        (new SubFx(new Interval(), new Equality()))('foo');
        
        return;
    }
    
    /**
     * __invoke() should return null if $x is outside the sub-function's interval
     */
    public function testInvokeReturnsNullIfXIsOutsideInterval()
    {
        $x = 999;
        
        $interval = new Interval('[0, 1]');
        
        $fx = new Equality();
        
        $subFx = new SubFx($interval, $fx);
        
        $this->assertNull($subFx($x));
        
        return;
    }
    
    /**
     * __invoke() should return number if $x is inside the sub-function's interval
     */
    public function testInvokeReturnsNumberIfXIsInsideInterval()
    {
        $x = 1;
        
        $interval = new Interval('[0, 1]');
        
        $fx = new Equality();
        
        $subFx = new SubFx($interval, $fx);
        
        $this->assertEquals($x, $subFx($x));
        
        return;
    }
    
    
    /* !getFx() */
    
    /**
     * getFx() should return the sub-function's function
     */
    public function testGetFx()
    {
        $fx = new Equality();
        
        $subFx = new SubFx(new Interval(), new Equality());
        
        $this->setProperty('fx', $subFx, $fx);
        
        $this->assertSame($fx, $subFx->getFx());
        
        return;
    }
    
    
    /* !getInterval() */
    
    /**
     * getInterval() should return the sub-function's interval
     */
    public function testGetInterval()
    {
        $interval = new Interval();
        
        $subFx = new SubFx(new Interval(), new Equality());
        
        $this->setProperty('interval', $subFx, $interval);
        
        $this->assertSame($interval, $subFx->getInterval());
        
        return;
    }
    
}
