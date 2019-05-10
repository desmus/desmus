<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method ProjectTSGaleryTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistDelete first($columns = ['*'])
*/
class ProjectTSGaleryTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryTodolistDelete::class;
    }
}
