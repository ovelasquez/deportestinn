<?php

namespace AutenticacionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AutenticacionBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
