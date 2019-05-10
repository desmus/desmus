<?php

namespace App\Repositories;

use App\Models\JobTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method JobTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTodolistCreate find($id, $columns = ['*'])
 * @method JobTodolistCreate first($columns = ['*'])
*/
class JobTodolistCreateRepository extends BaseRepository
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
        return JobTodolistCreate::class;
    }
}
