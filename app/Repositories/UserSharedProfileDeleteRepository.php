<?php

namespace App\Repositories;

use App\Models\UserSharedProfileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserSharedProfileDeleteRepository
 * @package App\Repositories
 * @version April 23, 2019, 10:47 pm UTC
 *
 * @method UserSharedProfileDelete findWithoutFail($id, $columns = ['*'])
 * @method UserSharedProfileDelete find($id, $columns = ['*'])
 * @method UserSharedProfileDelete first($columns = ['*'])
*/
class UserSharedProfileDeleteRepository extends BaseRepository
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
        return UserSharedProfileDelete::class;
    }
}
