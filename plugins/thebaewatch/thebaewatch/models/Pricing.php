<?php namespace Thebaewatch\Thebaewatch\Models;

use Model;

/**
 * Model
 */
class Pricing extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'thebaewatch_thebaewatch_pricing';



    

    public $belongsToMany = [

        'features' => [

            'Thebaewatch\Thebaewatch\Models\Features',
            'table' => 'thebaewatch_thebaewatch_features_pricing',
            'order' => 'id desc',

        ],

    ];

    


}
