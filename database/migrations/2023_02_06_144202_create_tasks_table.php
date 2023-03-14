<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('img_src');
<<<<<<< HEAD:database/migrations/2023_02_06_144202_create_tasks_table.php
            $table->string('lead_time');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('project_id');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

=======
            $table->integer('elapsed_time');
            $table->foreignId('desk_column_id')
                ->constrained('desk_columns')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
>>>>>>> dea7e3a... fix errors templates:database/migrations/2023_03_10_101757_create_tasks_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
