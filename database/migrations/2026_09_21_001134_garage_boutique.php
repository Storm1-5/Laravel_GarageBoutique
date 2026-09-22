<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $columns = collect([
            'date_of_birth' => fn (Blueprint $table) => $table->date('date_of_birth')->nullable(),
            'country' => fn (Blueprint $table) => $table->string('country')->nullable(),
            'is_owner' => fn (Blueprint $table) => $table->boolean('is_owner')->default(false),
        ])->reject(fn ($definition, string $column): bool => Schema::hasColumn('users', $column));

        if ($columns->isNotEmpty()) {
            Schema::table('users', function (Blueprint $table) use ($columns): void {
                foreach ($columns as $definition) {
                    $definition($table);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['date_of_birth', 'country', 'is_owner']);
        });
    }
};
