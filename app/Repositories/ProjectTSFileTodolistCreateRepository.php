<?php

namespace App\Repositories;

use App\Models\ProjectTSFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method ProjectTSFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSFileTodolistCreate first($columns = ['*'])
*/
class ProjectTSFileTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileTodolistCreate::class;
    }
}
