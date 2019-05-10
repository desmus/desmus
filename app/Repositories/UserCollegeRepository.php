<?php

namespace App\Repositories;

use App\Models\UserCollege;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserCollege findWithoutFail($id, $columns = ['*'])
 * @method UserCollege find($id, $columns = ['*'])
 * @method UserCollege first($columns = ['*'])
*/
class UserCollegeRepository extends BaseRepository
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
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollege::class;
    }
}
