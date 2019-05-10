<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method ProjectTSNoteTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistDelete first($columns = ['*'])
*/
class ProjectTSNoteTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteTodolistDelete::class;
    }
}
