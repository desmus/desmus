<?php

namespace App\Repositories;

use App\Models\UserJobD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:02 pm UTC
 *
 * @method UserJobD findWithoutFail($id, $columns = ['*'])
 * @method UserJobD find($id, $columns = ['*'])
 * @method UserJobD first($columns = ['*'])
*/
class UserJobDRepository extends BaseRepository
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
        return UserJobD::class;
    }
}
