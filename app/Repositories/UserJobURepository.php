<?php

namespace App\Repositories;

use App\Models\UserJobU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserJobU findWithoutFail($id, $columns = ['*'])
 * @method UserJobU find($id, $columns = ['*'])
 * @method UserJobU first($columns = ['*'])
*/
class UserJobURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobU::class;
    }
}
