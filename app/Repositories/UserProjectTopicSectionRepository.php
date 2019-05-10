<?php

namespace App\Repositories;

use App\Models\UserProjectTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserProjectTopicSection findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicSection find($id, $columns = ['*'])
 * @method UserProjectTopicSection first($columns = ['*'])
*/
class UserProjectTopicSectionRepository extends BaseRepository
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
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTopicSection::class;
    }
}
