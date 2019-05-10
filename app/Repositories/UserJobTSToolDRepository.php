<?php

namespace App\Repositories;

use App\Models\UserJobTSToolD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:06 pm UTC
 *
 * @method UserJobTSToolD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolD find($id, $columns = ['*'])
 * @method UserJobTSToolD first($columns = ['*'])
*/
class UserJobTSToolDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolD::class;
    }
}
