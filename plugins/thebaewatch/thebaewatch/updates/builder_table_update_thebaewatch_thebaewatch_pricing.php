<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchPricing extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_pricing', function($table)
        {
            $table->boolean('public');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->increments('id')->nullable(false)->unsigned()->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_pricing', function($table)
        {
            $table->dropColumn('public');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('deleted_at');
            $table->increments('id')->nullable(false)->unsigned()->default(null)->change();
        });
    }
}
