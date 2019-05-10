<?php

namespace App\Repositories;

use App\Models\ProjectTSFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method ProjectTSFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSFileTodolistDelete first($columns = ['*'])
*/
class ProjectTSFileTodolistDeleteRepository extends BaseRepository
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
        return ProjectTSFileTodolistDelete::class;
    }
}
