<?php

namespace App\Repositories;

use App\Models\ProjectTSToolUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTSToolUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolUpdate find($id, $columns = ['*'])
 * @method ProjectTSToolUpdate first($columns = ['*'])
*/
class ProjectTSToolUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolUpdate::class;
    }
}
