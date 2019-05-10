<?php

namespace App\Repositories;

use App\Models\ProjectTSToolView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectTSToolView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolView find($id, $columns = ['*'])
 * @method ProjectTSToolView first($columns = ['*'])
*/
class ProjectTSToolViewRepository extends BaseRepository
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
        return ProjectTSToolView::class;
    }
}
