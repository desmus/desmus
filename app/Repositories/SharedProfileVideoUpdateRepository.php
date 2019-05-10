<?php

namespace App\Repositories;

use App\Models\SharedProfileVideoUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoUpdateRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:30 pm UTC
 *
 * @method SharedProfileVideoUpdate findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideoUpdate find($id, $columns = ['*'])
 * @method SharedProfileVideoUpdate first($columns = ['*'])
*/
class SharedProfileVideoUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        's_p_v_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileVideoUpdate::class;
    }
}
