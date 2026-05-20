<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop tables that are part of Laravel's default scaffolding
     * but are not used by this application.
     *
     * - password_reset_tokens: Forgot Password feature has been removed
     * - cache / cache_locks: App uses file-based caching, not DB driver
     * - jobs / job_batches / failed_jobs: No queue jobs are used
     * - sessions: App uses file-based sessions, not DB driver
     */
    public function up(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('sessions');
    }

    /**
     * Reverse the migrations (no-op — we don't recreate these).
     */
    public function down(): void
    {
        // Intentionally empty — no need to recreate unused tables
    }
};
