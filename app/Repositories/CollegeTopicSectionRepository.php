<?php

namespace App\Repositories;

use App\Models\CollegeTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTopicSection findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSection find($id, $columns = ['*'])
 * @method CollegeTopicSection first($columns = ['*'])
*/
class CollegeTopicSectionRepository extends BaseRepository
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
        'college_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSection::class;
    }
}
