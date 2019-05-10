<?php

namespace App\Repositories;

use App\Models\UserJobTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserJobTopicSection findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopicSection find($id, $columns = ['*'])
 * @method UserJobTopicSection first($columns = ['*'])
*/
class UserJobTopicSectionRepository extends BaseRepository
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
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTopicSection::class;
    }
}
