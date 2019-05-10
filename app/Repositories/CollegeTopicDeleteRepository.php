<?php

namespace App\Repositories;

use App\Models\CollegeTopicDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method CollegeTopicDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicDelete find($id, $columns = ['*'])
 * @method CollegeTopicDelete first($columns = ['*'])
*/
class CollegeTopicDeleteRepository extends BaseRepository
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
        return CollegeTopicDelete::class;
    }
}
