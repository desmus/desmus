<?php

namespace App\Repositories;

use App\Models\ProjectTopicCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTopicCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicCreate find($id, $columns = ['*'])
 * @method ProjectTopicCreate first($columns = ['*'])
*/
class ProjectTopicCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicCreate::class;
    }
}
