<?php

namespace App\Repositories;

use App\Models\ProjectTopicUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTopicUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicUpdate find($id, $columns = ['*'])
 * @method ProjectTopicUpdate first($columns = ['*'])
*/
class ProjectTopicUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicUpdate::class;
    }
}
