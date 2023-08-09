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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('status');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->integer('budget')->nullable();
            $table->integer('client_id');
            $table->string('notes')->nullable();
            $table->string('files')->nullable();
            $table->integer('tasks')->nullable();
            // create a relationship between the project and the client
            // $table->foreign('project_client_id')->references('id')->on('clients');
            // create a relationship between the project and tasks
            // $table->foreign('project_tasks')->references('id')->on('tasks');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
