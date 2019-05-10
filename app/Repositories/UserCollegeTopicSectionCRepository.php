<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicSectionC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicSectionCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserCollegeTopicSectionC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicSectionC find($id, $columns = ['*'])
 * @method UserCollegeTopicSectionC first($columns = ['*'])
*/
class UserCollegeTopicSectionCRepository extends BaseRepository
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
        return UserCollegeTopicSectionC::class;
    }
}
