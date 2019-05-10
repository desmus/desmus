<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method CollegeTSToolFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolist find($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolist first($columns = ['*'])
*/
class CollegeTSToolFileTodolistRepository extends BaseRepository
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
        'c_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileTodolist::class;
    }
}
