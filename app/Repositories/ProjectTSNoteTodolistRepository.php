<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method ProjectTSNoteTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteTodolist find($id, $columns = ['*'])
 * @method ProjectTSNoteTodolist first($columns = ['*'])
*/
class ProjectTSNoteTodolistRepository extends BaseRepository
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
        'p_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteTodolist::class;
    }
}
