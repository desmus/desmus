<?php

namespace App\Repositories;

use App\Models\UserCollegeTopicSectionD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicSectionDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserCollegeTopicSectionD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopicSectionD find($id, $columns = ['*'])
 * @method UserCollegeTopicSectionD first($columns = ['*'])
*/
class UserCollegeTopicSectionDRepository extends BaseRepository
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
        return UserCollegeTopicSectionD::class;
    }
}
