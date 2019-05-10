<?php

namespace App\Repositories;

use App\Models\JobTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method JobTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTodolistDelete find($id, $columns = ['*'])
 * @method JobTodolistDelete first($columns = ['*'])
*/
class JobTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTodolistDelete::class;
    }
}
