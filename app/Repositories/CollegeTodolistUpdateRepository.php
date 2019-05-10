<?php

namespace App\Repositories;

use App\Models\CollegeTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method CollegeTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTodolistUpdate first($columns = ['*'])
*/
class CollegeTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTodolistUpdate::class;
    }
}
