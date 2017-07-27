<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThebaewatchThebaewatchMarketing extends Migration
{
    public function up()
    {
        Schema::create('thebaewatch_thebaewatch_marketing', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('description');
            $table->string('photo');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thebaewatch_thebaewatch_marketing');
    }
}
