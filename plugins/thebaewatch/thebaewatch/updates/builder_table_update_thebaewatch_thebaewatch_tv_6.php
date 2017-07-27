<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchTv6 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->increments('show_id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->increments('show_id')->unsigned()->change();
        });
    }
}
