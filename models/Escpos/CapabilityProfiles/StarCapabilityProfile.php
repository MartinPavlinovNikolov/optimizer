<?php

namespace Optimizer\Models\Escpos\CapabilityProfiles;

use Optimizer\Models\Escpos\CapabilityProfile;

class StarCapabilityProfile
{
    public static function getInstance()
    {
        return CapabilityProfile::load('SP2000');
    }
}
