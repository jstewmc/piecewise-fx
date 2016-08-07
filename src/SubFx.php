<?php
/**
 * The file for a sub-function
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\PiecewiseFx;

use InvalidArgumentException;
use Jstewmc\Fx\Fx;
use Jstewmc\Interval\Interval;

/**
 * A sub-function
 *
 * @since  0.1.0
 */
class SubFx
{
    /* !Private properties */
    
    /**
     * @var    Fx  the sub-function's function
     * @since  0.1.0
     */
    private $fx;
    
    /**
     * @var    Interval  the sub-function's interval
     * @since  0.1.0
     */
    private $interval;
    
    
    /* !Magic methods */ 
    
    /**
     * Called when the sub-function is constructed
     *
     * @param  Interval  $interval  the sub-function's interval
     * @param  Fx        $fx        the sub-function's function
     * @since  0.1.0
     */
    public function __construct(Interval $interval, Fx $fx)
    {
        $this->interval = $interval;
        $this->fx       = $fx;
    }
    
    /**
     * Called when the class is treated like a (PHP) function
     *
     * @param   int|float  $x  the function's variable
     * @return  mixed
     * @throws  InvalidArgumentException  if $x is not a number
     * @since   0.1.0
     */
    public function __invoke($x)
    {
        // if $x is not a number, short-circuit
        if ( ! is_numeric($x)) {
            throw new InvalidArgumentException(
                __METHOD__ . "() expects parameter one, x, to be a number"
            );
        }
        
        // if $x is outside the sub-function's interval, short-circuit
        if ($this->interval->compare($x) !== 0) {
            return null;
        }
        
        return ($this->fx)($x);
    }
    
    
    /* !Get methods */
    
    /**
     * Returns the sub-function's function
     *
     * @return  Fx
     * @since   0.1.0
     */
    public function getFx(): Fx
    {
        return $this->fx;
    }
    
    /**
     * Returns the sub-function's interval
     *
     * @return  Interval
     * @since   0.1.0
     */
    public function getInterval(): Interval
    {
        return $this->interval;
    }
}
