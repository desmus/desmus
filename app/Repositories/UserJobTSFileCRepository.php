<?php

namespace App\Repositories;

use App\Models\UserJobTSFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserJobTSFileC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSFileC find($id, $columns = ['*'])
 * @method UserJobTSFileC first($columns = ['*'])
*/
class UserJobTSFileCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSFileC::class;
    }
}
