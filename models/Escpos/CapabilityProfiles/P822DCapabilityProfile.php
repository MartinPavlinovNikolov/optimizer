<?php

namespace Optimizer\Models\Escpos\CapabilityProfiles;

use Optimizer\Models\Escpos\CapabilityProfile;

class P822DCapabilityProfile
{
    public static function getInstance()
    {
        return CapabilityProfile::load('P822D');
    }
}
