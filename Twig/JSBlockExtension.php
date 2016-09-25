<?php

namespace Fousky\JSBlockBundle\Twig;

use Fousky\JSBlockBundle\Twig\TokenParser\JSTokenParser;

/**
 * @author Lukáš Brzák <lukas.brzak@email.cz>
 */
class JSBlockExtension extends \Twig_Extension
{
    /** @var array $collected */
    protected $collected = array();

    /** @var bool $lock */
    protected $lock = false;

    /**
     * Returns the token parser instance to add to the existing list.
     *
     * @return array An array of Twig_TokenParser instances
     */
    public function getTokenParsers()
    {
        return array(
            new JSTokenParser(), // {% jsblock %}
        );
    }

    /**
     * Render collected javascripts (should be before tag </body>)
     *
     * {% jsblock 'render' %}
     *
     * @return string
     */
    public function render()
    {
        return implode("\n    ", $this->collected) . "\n";
    }

    /**
     * Start collecting of some javascripts
     *
     * {% jsblock 'start' %}
     *
     * @throws \BadFunctionCallException
     */
    public function start()
    {
        if ($this->lock) {
            throw new \BadFunctionCallException('Cannot use {% jsblock \'start\' %} inside multiple nesting level.');
        }

        $this->lock = true;
        \ob_start();
    }

    /**
     * Finish collecting of javascripts
     *
     * {% jsblock 'stop' %}
     */
    public function stop()
    {
        $data = \ob_get_clean();
        $this->lock = false;
        $this->collected[] = $data;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fousky_js_block_extension';
    }
}
