<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zip_files', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type")->default("file");
            $table->string("extension")->nullable();
            $table->String("location")->nullable();
            $table->string("path")->index()->nullable();
            $table->string("size")->default(0);
            $table->foreignId('zip_id')->nullable()->constrained("zips")
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete()
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zip_files');
    }
};
