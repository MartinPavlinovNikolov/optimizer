<?php

namespace Optimizer\Models\Escpos\CapabilityProfiles;

use Optimizer\Models\Escpos\CapabilityProfile;

class SimpleCapabilityProfile
{
    public static function getInstance()
    {
        return CapabilityProfile::load('simple');
    }
}
