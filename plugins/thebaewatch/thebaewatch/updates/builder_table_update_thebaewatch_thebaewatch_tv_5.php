<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchTv5 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->increments('show_id');
            $table->dropColumn('id');
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->dropColumn('show_id');
            $table->string('id', 255)->nullable();
        });
    }
}
