<?php

namespace App\Repositories;

use App\Models\JobTSToolFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method JobTSToolFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileTodolist find($id, $columns = ['*'])
 * @method JobTSToolFileTodolist first($columns = ['*'])
*/
class JobTSToolFileTodolistRepository extends BaseRepository
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
        'j_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileTodolist::class;
    }
}
