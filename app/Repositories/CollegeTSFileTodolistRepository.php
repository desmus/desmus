<?php

namespace App\Repositories;

use App\Models\CollegeTSFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method CollegeTSFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileTodolist find($id, $columns = ['*'])
 * @method CollegeTSFileTodolist first($columns = ['*'])
*/
class CollegeTSFileTodolistRepository extends BaseRepository
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
        'c_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileTodolist::class;
    }
}
