<?php

namespace App\Repositories;

use App\Models\UserCollegeU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserCollegeU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeU find($id, $columns = ['*'])
 * @method UserCollegeU first($columns = ['*'])
*/
class UserCollegeURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeU::class;
    }
}
