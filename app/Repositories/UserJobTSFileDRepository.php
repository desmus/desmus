<?php

namespace App\Repositories;

use App\Models\UserJobTSFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserJobTSFileD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSFileD find($id, $columns = ['*'])
 * @method UserJobTSFileD first($columns = ['*'])
*/
class UserJobTSFileDRepository extends BaseRepository
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
        return UserJobTSFileD::class;
    }
}
