<?php

namespace App\Repositories;

use App\Models\CollegeTSToolTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method CollegeTSToolTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSToolTodolistUpdate first($columns = ['*'])
*/
class CollegeTSToolTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolTodolistUpdate::class;
    }
}
