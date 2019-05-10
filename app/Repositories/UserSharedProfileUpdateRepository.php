<?php

namespace App\Repositories;

use App\Models\UserSharedProfileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserSharedProfileUpdateRepository
 * @package App\Repositories
 * @version April 23, 2019, 10:47 pm UTC
 *
 * @method UserSharedProfileUpdate findWithoutFail($id, $columns = ['*'])
 * @method UserSharedProfileUpdate find($id, $columns = ['*'])
 * @method UserSharedProfileUpdate first($columns = ['*'])
*/
class UserSharedProfileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_shared_profile_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserSharedProfileUpdate::class;
    }
}
