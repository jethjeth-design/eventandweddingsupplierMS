<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log($action, $user = null, $properties = [])
    {
        ActivityLog::create([
            'user_id' => $user?->id,
            'action' => $action,
            'role' => $user?->role,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'properties' => $properties,
        ]);
    }
}