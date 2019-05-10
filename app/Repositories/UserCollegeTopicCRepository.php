<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserCollegeTopicC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicC find($id, $columns = ['*'])
 * @method UserCollegeTopicC first($columns = ['*'])
*/
class UserCollegeTopicCRepository extends BaseRepository
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
        return UserCollegeTopicC::class;
    }
}
