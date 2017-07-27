<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThebaewatchThebaewatchTv extends Migration
{
    public function up()
    {
        Schema::create('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('id')->nullable();
            $table->string('title')->nullable();
            $table->string('media_id')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thebaewatch_thebaewatch_tv');
    }
}
