<?php
/**
 * The file for a piecewise function
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\PiecewiseFx;

use InvalidArgumentException;

/**
 * A piecewise function
 *
 * @since  0.1.0
 */
class PiecewiseFx
{
    /* !Private properties */
    
    /**
     * @var    SubFx[]  the piecewise function's sub-functions
     * @since  0.1.0
     */
    private $subFxs = [];
    
    
    /* !Magic methods */
    
    /**
     * Called when the piecewise-function is constructed
     *
     * @param  SubFx[]  $subFxs  an array of sub-functions
     * @since  0.1.0
     */
    public function __construct($subFxs = [])
    {
        $this->subFxs = $subFxs;
    }
    
    /**
     * Called when the function is treated like a (PHP) function
     *
     * @param   int|float  $x  the variable
     * @return  int|float
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
        
        // otherwise, loop through the piecewise-function's sub-functions
        foreach ($this->subFxs as $subFx) {
            // if $x is inside the sub-function's interval
            if ($subFx->getInterval()->compare($x) === 0) {
                // roll it!
                return $subFx($x);
            }
        }
        
        return null;
    }
}
