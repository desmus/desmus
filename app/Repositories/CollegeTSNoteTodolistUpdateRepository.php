<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method CollegeTSNoteTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistUpdate first($columns = ['*'])
*/
class CollegeTSNoteTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteTodolistUpdate::class;
    }
}
