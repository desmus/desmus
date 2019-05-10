<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicSectionU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicSectionURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserCollegeTopicSectionU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicSectionU find($id, $columns = ['*'])
 * @method UserCollegeTopicSectionU first($columns = ['*'])
*/
class UserCollegeTopicSectionURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTopicSectionU::class;
    }
}
