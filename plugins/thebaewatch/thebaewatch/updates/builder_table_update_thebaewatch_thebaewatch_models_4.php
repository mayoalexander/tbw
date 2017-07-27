<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchModels4 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->boolean('public')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->dropColumn('public');
        });
    }
}
