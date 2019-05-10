<?php

namespace App\Repositories;

use App\Models\JobTSNoteTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method JobTSNoteTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteTodolist find($id, $columns = ['*'])
 * @method JobTSNoteTodolist first($columns = ['*'])
*/
class JobTSNoteTodolistRepository extends BaseRepository
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
        'j_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteTodolist::class;
    }
}
