<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThebaewatchThebaewatchModels extends Migration
{
    public function up()
    {
        Schema::create('thebaewatch_thebaewatch_models', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thebaewatch_thebaewatch_models');
    }
}
