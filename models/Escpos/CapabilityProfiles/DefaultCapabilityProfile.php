<?php

namespace Optimizer\Models\Escpos\CapabilityProfiles;

use Optimizer\Models\Escpos\CapabilityProfile;

class DefaultCapabilityProfile
{
    public static function getInstance()
    {
        return CapabilityProfile::load('default');
    }
}
