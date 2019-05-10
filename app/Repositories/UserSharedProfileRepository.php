<?php

namespace App\Repositories;

use App\Models\UserSharedProfile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserSharedProfileRepository
 * @package App\Repositories
 * @version April 23, 2019, 10:46 pm UTC
 *
 * @method UserSharedProfile findWithoutFail($id, $columns = ['*'])
 * @method UserSharedProfile find($id, $columns = ['*'])
 * @method UserSharedProfile first($columns = ['*'])
*/
class UserSharedProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'shared_user_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserSharedProfile::class;
    }
}
