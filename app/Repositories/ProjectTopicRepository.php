<?php

namespace App\Repositories;

use App\Models\ProjectTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method ProjectTopic findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopic find($id, $columns = ['*'])
 * @method ProjectTopic first($columns = ['*'])
*/
class ProjectTopicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopic::class;
    }
}
