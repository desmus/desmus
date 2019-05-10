<?php

namespace App\Repositories;

use App\Models\UserSharedProfileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserSharedProfileCreateRepository
 * @package App\Repositories
 * @version April 23, 2019, 10:47 pm UTC
 *
 * @method UserSharedProfileCreate findWithoutFail($id, $columns = ['*'])
 * @method UserSharedProfileCreate find($id, $columns = ['*'])
 * @method UserSharedProfileCreate first($columns = ['*'])
*/
class UserSharedProfileCreateRepository extends BaseRepository
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
        return UserSharedProfileCreate::class;
    }
}
