<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method ProjectTSGaleryTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistCreate first($columns = ['*'])
*/
class ProjectTSGaleryTodolistCreateRepository extends BaseRepository
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
        return ProjectTSGaleryTodolistCreate::class;
    }
}
