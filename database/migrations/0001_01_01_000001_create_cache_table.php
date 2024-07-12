<?php

declare(strict_types=1);

use App\Traits\ConfigTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    use ConfigTrait;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if ( ! $this->isTestingEnvironment()) {
            return;
        }

        Schema::create('cache', static function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', static function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ( ! $this->isTestingEnvironment()) {
            return;
        }

        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
