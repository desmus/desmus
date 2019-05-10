<?php

namespace App\Repositories;

use App\Models\JobTSFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method JobTSFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileTodolist find($id, $columns = ['*'])
 * @method JobTSFileTodolist first($columns = ['*'])
*/
class JobTSFileTodolistRepository extends BaseRepository
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
        'j_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileTodolist::class;
    }
}
