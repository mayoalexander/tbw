<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThebaewatchThebaewatchPricing extends Migration
{
    public function up()
    {
        Schema::create('thebaewatch_thebaewatch_pricing', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->decimal('price', 10, 0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thebaewatch_thebaewatch_pricing');
    }
}
