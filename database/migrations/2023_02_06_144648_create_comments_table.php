<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id');
            $table->string('description');
<<<<<<< HEAD:database/migrations/2023_02_06_144648_create_comments_table.php

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
=======
            $table->string('img_src');
            $table->integer('elapsed_time');
            $table->foreignId('desk_column_template_id')
                ->constrained('desk_columns_templates')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
>>>>>>> dea7e3a... fix errors templates:database/migrations/2023_03_10_130201_create_task_templates_table.php

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
        Schema::dropIfExists('comments');
    }
}
