<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_templates', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description');
            $table->string('img_src');
            $table->integer('elapsed_time');
            $table->unsignedBigInteger('desk_column_template_id');

            $table->foreign('desk_column_template_id')
                ->references('id')
                ->on('desk_columns_templates')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('task_templates');
    }
}
