<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method CollegeTopicSectionUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionUpdate find($id, $columns = ['*'])
 * @method CollegeTopicSectionUpdate first($columns = ['*'])
*/
class CollegeTopicSectionUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSectionUpdate::class;
    }
}
