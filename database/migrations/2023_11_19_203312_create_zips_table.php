<?php

use App\Models\Zip;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("path")->nullable();
            $table->string("status")->default(Zip::STATUS_WAIT);
            $table->string("size")->default(0);
            $table->foreignId('user_id')->nullable()->constrained("users")
                    ->cascadeOnUpdate()
                    ->nullOnDelete()
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zips');
    }
};
