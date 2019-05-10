<?php

namespace App\Repositories;

use App\Models\UserCollegeC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:52 pm UTC
 *
 * @method UserCollegeC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeC find($id, $columns = ['*'])
 * @method UserCollegeC first($columns = ['*'])
*/
class UserCollegeCRepository extends BaseRepository
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
        return UserCollegeC::class;
    }
}
