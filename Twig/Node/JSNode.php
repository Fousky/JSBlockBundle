<?php

namespace Fousky\JSBlockBundle\Twig\Node;

/**
 * @author Lukáš Brzák <lukas.brzak@email.cz>
 */
class JSNode extends \Twig_Node
{
    /**
     * @param \Twig_Node $method
     * @param int        $lineno
     * @param null       $tag
     */
    public function __construct(\Twig_Node $method, $lineno = 0, $tag = null)
    {
        parent::__construct(['method' => $method], [], $lineno, $tag);
    }

    /**
     * Kompilování.
     *
     * @param \Twig_Compiler A Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("print \$this->env->getExtension('Fousky\\JSBlockBundle\\Twig\\JSBlockExtension')->")
            ->raw($this->getNode('method')->getAttribute('value'))
            ->raw("();\n");
    }
}
