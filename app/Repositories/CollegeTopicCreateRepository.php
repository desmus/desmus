<?php

namespace App\Repositories;

use App\Models\CollegeTopicCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTopicCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicCreate find($id, $columns = ['*'])
 * @method CollegeTopicCreate first($columns = ['*'])
*/
class CollegeTopicCreateRepository extends BaseRepository
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
        return CollegeTopicCreate::class;
    }
}
