<?php

namespace App\Repositories;

use App\Models\ProjectTopicView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectTopicView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicView find($id, $columns = ['*'])
 * @method ProjectTopicView first($columns = ['*'])
*/
class ProjectTopicViewRepository extends BaseRepository
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
        return ProjectTopicView::class;
    }
}
