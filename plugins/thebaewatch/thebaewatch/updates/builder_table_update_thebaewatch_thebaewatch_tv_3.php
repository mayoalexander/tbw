<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchTv3 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->text('episodes')->nullable();
            $table->renameColumn('media_id', 'subtitle');
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->dropColumn('episodes');
            $table->renameColumn('subtitle', 'media_id');
        });
    }
}
