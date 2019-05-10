<?php

namespace App\Repositories;

use App\Models\ProjectTSToolCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTSToolCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolCreate find($id, $columns = ['*'])
 * @method ProjectTSToolCreate first($columns = ['*'])
*/
class ProjectTSToolCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolCreate::class;
    }
}
