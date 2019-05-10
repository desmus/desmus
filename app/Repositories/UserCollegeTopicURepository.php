<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserCollegeTopicU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicU find($id, $columns = ['*'])
 * @method UserCollegeTopicU first($columns = ['*'])
*/
class UserCollegeTopicURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTopicU::class;
    }
}
