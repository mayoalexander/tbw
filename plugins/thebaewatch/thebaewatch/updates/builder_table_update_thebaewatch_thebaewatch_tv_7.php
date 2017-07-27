<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchTv7 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->renameColumn('show_id', 'id');
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->renameColumn('id', 'show_id');
        });
    }
}
