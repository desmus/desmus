<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserCollegeTopicSection findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicSection find($id, $columns = ['*'])
 * @method UserCollegeTopicSection first($columns = ['*'])
*/
class UserCollegeTopicSectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'college_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTopicSection::class;
    }
}
