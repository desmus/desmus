<?php

namespace App\Repositories;

use App\Models\ProjectTSToolDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method ProjectTSToolDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolDelete find($id, $columns = ['*'])
 * @method ProjectTSToolDelete first($columns = ['*'])
*/
class ProjectTSToolDeleteRepository extends BaseRepository
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
        return ProjectTSToolDelete::class;
    }
}
