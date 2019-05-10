<?php

namespace App\Repositories;

use App\Models\ProjectTopicDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method ProjectTopicDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicDelete find($id, $columns = ['*'])
 * @method ProjectTopicDelete first($columns = ['*'])
*/
class ProjectTopicDeleteRepository extends BaseRepository
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
        return ProjectTopicDelete::class;
    }
}
