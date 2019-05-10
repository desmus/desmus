<?php

namespace App\Repositories;

use App\Models\CollegeTopicView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeTopicView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicView find($id, $columns = ['*'])
 * @method CollegeTopicView first($columns = ['*'])
*/
class CollegeTopicViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicView::class;
    }
}
