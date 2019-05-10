<?php

namespace App\Repositories;

use App\Models\JobTSPTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPTodolistRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method JobTSPTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSPTodolist find($id, $columns = ['*'])
 * @method JobTSPTodolist first($columns = ['*'])
*/
class JobTSPTodolistRepository extends BaseRepository
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
        'j_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPTodolist::class;
    }
}
