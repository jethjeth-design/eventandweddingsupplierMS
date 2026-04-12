<?php

use App\Models\ActivityLog;

if (!function_exists('logActivity')) {
    function logActivity($action, $user = null, $properties = [])
    {
        ActivityLog::create([
            'user_id'     => $user?->id,
            'action'      => $action,
            'role'        => $user?->role,
            'ip_address'  => Request::ip(),
            'user_agent'  => Request::header('User-Agent'),
            'properties'  => $properties,
        ]);
    }
}