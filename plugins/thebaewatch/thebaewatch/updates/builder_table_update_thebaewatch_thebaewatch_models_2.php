<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchModels2 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
