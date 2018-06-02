<?php 

namespace App\Primitives;

class Money
{
    private $pence;

    private function __construct($pence)
    {
        $this->pence = (integer) $pence;
    }

    public static function fromPounds($pounds)
    {
        return new static($pounds * 100);
    }

    public static function fromPence($pence)
    {
        return new static($pence);
    }

    public function inPence()
    {
        return (string) $this->pence;
    }

    public function inPounds()
    {
        return (string) ($this->pence / 100);
    }

    public function inPoundsAndPence()
    {
        return number_format($this->pence / 100, 2);
    }
}
