<?php

namespace App\Repositories;

use App\Models\UserJobTSToolFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserJobTSToolFileC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolFileC find($id, $columns = ['*'])
 * @method UserJobTSToolFileC first($columns = ['*'])
*/
class UserJobTSToolFileCRepository extends BaseRepository
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
        return UserJobTSToolFileC::class;
    }
}
