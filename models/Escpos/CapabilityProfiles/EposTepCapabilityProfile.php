<?php

namespace Optimizer\Models\Escpos\CapabilityProfiles;

use Optimizer\Models\Escpos\CapabilityProfile;

class EposTepCapabilityProfile
{
    public static function getInstance()
    {
        return CapabilityProfile::load('TEP-200M');
    }
}
