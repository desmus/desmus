<?php

namespace App\Repositories;

use App\Models\UserJobTSToolFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:08 pm UTC
 *
 * @method UserJobTSToolFileD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolFileD find($id, $columns = ['*'])
 * @method UserJobTSToolFileD first($columns = ['*'])
*/
class UserJobTSToolFileDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolFileD::class;
    }
}
