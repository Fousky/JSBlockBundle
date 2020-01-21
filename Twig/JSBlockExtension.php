<?php declare(strict_types = 1);

namespace Fousky\JSBlockBundle\Twig;

use Fousky\JSBlockBundle\Twig\TokenParser\JSTokenParser;
use Twig\Extension\AbstractExtension;

class JSBlockExtension extends AbstractExtension
{
    /** @var array $collected */
    protected $collected = [];

    /** @var bool $lock */
    protected $lock = false;

    public function getTokenParsers(): array
    {
        return [
            new JSTokenParser(), // {% jsblock %}
        ];
    }

    public function render(): string
    {
        return implode("\n    ", $this->collected)."\n";
    }

    public function start(): void
    {
        if ($this->lock) {
            throw new \BadFunctionCallException('Cannot use {% jsblock \'start\' %} inside multiple nesting level.');
        }

        $this->lock = true;
        \ob_start();
    }

    public function stop(): void
    {
        $data = \ob_get_clean();
        $this->lock = false;
        $this->collected[] = $data;
    }
}
