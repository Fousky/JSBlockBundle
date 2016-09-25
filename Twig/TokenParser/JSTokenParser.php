<?php

namespace Fousky\JSBlockBundle\Twig\TokenParser;

use Fousky\JSBlockBundle\Twig\Node\JSNode;

/**
 * @author Lukáš Brzák <lukas.brzak@email.cz>
 */
class JSTokenParser extends \Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token
     *
     * @throws \Twig_Error_Syntax
     *
     * @return \Twig_NodeInterface
     */
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $value = $this->parser->getExpressionParser()->parseExpression();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new JSNode($value, $token->getLine(), $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     */
    public function getTag()
    {
        return 'jsblock';
    }
}
