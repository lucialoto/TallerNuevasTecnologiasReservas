<?php

namespace UNTDF\ReservasAulasBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UNTDFReservasAulasBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
