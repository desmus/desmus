<?php

namespace App\Repositories;

use App\Models\UserProjectU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserProjectU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectU find($id, $columns = ['*'])
 * @method UserProjectU first($columns = ['*'])
*/
class UserProjectURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectU::class;
    }
}
