<?php

declare(strict_types=1);

namespace BrasilapiLaravel\Endpoints\IBGE;

class IBGE
{
    public function states(): State
    {
        return new State();
    }

    public function cities(): City
    {
        return new City();
    }
}
