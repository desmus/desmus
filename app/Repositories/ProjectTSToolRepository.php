<?php

namespace App\Repositories;

use App\Models\ProjectTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method ProjectTSTool findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSTool find($id, $columns = ['*'])
 * @method ProjectTSTool first($columns = ['*'])
*/
class ProjectTSToolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSTool::class;
    }
}
