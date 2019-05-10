<?php

namespace App\Repositories;

use App\Models\UserJobTSFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserJobTSFileU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSFileU find($id, $columns = ['*'])
 * @method UserJobTSFileU first($columns = ['*'])
*/
class UserJobTSFileURepository extends BaseRepository
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
        return UserJobTSFileU::class;
    }
}
