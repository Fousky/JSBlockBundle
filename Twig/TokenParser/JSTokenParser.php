<?php declare(strict_types = 1);

namespace Fousky\JSBlockBundle\Twig\TokenParser;

use Fousky\JSBlockBundle\Twig\Node\JSNode;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * @author Lukáš Brzák <lukas.brzak@email.cz>
 */
class JSTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $stream = $this->parser->getStream();
        $value = $this->parser->getExpressionParser()->parseExpression();
        $stream->expect(Token::BLOCK_END_TYPE);

        return new JSNode($value, $token->getLine(), $this->getTag());
    }

    public function getTag(): string
    {
        return 'jsblock';
    }
}
