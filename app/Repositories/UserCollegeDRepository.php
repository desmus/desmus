<?php

namespace App\Repositories;

use App\Models\UserCollegeD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserCollegeD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeD find($id, $columns = ['*'])
 * @method UserCollegeD first($columns = ['*'])
*/
class UserCollegeDRepository extends BaseRepository
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
        return UserCollegeD::class;
    }
}
