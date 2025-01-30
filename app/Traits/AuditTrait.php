<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait AuditTrait
{
    /**
     * Generate an audit log entry.
     *
     * @param string $event
     * @param object $auditable
     * @param array $oldValues
     * @param array $newValues
     * @param string|null $tags
     * @return void
     */
    public function generateAudit(
        string $event,
        object $auditable,
        array $oldValues = [],
        array $newValues = [],
        string $tags = null
    ) {

        DB::table('audits')->insert([
            'user_type' => auth()->user()->getMorphClass(),
            'user_id' => auth()->id(),
            'event' => $event,
            'auditable_type' => get_class($auditable),
            'auditable_id' => $auditable->id,
            'old_values' => json_encode($oldValues),
            'new_values' => json_encode($newValues),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'tags' => $tags,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
