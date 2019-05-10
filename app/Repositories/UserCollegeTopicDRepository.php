<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserCollegeTopicD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicD find($id, $columns = ['*'])
 * @method UserCollegeTopicD first($columns = ['*'])
*/
class UserCollegeTopicDRepository extends BaseRepository
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
        return UserCollegeTopicD::class;
    }
}
