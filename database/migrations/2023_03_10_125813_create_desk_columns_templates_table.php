<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskColumnsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_columns_templates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('desk_template_id');
            $table->string('status');

            $table->foreign('desk_template_id')
                ->references('id')
                ->on('desks_templates')
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
        Schema::dropIfExists('desk_columns_templates');
    }
}
