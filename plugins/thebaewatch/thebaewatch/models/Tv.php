<?php namespace Thebaewatch\Thebaewatch\Models;

use Model;

/**
 * Model
 */
class Tv extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'thebaewatch_thebaewatch_tv';

    public $jsonable = ['episodes'];


    public $attachMany = [
        'photo' => 'System\Models\File'
    ];

}