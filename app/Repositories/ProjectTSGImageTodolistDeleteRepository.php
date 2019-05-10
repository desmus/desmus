<?php

namespace App\Repositories;

use App\Models\ProjectTSGImageTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGImageTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method ProjectTSGImageTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistDelete first($columns = ['*'])
*/
class ProjectTSGImageTodolistDeleteRepository extends BaseRepository
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
        return ProjectTSGImageTodolistDelete::class;
    }
}
