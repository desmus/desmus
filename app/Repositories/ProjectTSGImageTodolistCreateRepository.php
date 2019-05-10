<?php

namespace App\Repositories;

use App\Models\ProjectTSGImageTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGImageTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method ProjectTSGImageTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistCreate first($columns = ['*'])
*/
class ProjectTSGImageTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGImageTodolistCreate::class;
    }
}
