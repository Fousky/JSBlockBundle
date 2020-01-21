<?php declare(strict_types = 1);

namespace Fousky\JSBlockBundle\Twig\Node;

use Twig\Compiler;
use Twig\Node\Node;

class JSNode extends Node
{
    public function __construct(Node $method, $lineno = 0, $tag = null)
    {
        parent::__construct(['method' => $method], [], $lineno, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("print \$this->env->getExtension('Fousky\\JSBlockBundle\\Twig\\JSBlockExtension')->")
            ->raw($this->getNode('method')->getAttribute('value'))
            ->raw("();\n");
    }
}
