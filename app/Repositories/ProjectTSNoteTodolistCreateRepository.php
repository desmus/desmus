<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method ProjectTSNoteTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistCreate first($columns = ['*'])
*/
class ProjectTSNoteTodolistCreateRepository extends BaseRepository
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
        return ProjectTSNoteTodolistCreate::class;
    }
}
