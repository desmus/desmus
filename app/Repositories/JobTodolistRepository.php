<?php

namespace App\Repositories;

use App\Models\JobTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:33 am UTC
 *
 * @method JobTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTodolist find($id, $columns = ['*'])
 * @method JobTodolist first($columns = ['*'])
*/
class JobTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'job_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTodolist::class;
    }
}
