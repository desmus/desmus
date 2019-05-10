<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSFileU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSFileURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserPersonalDataTSFileU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSFileU find($id, $columns = ['*'])
 * @method UserPersonalDataTSFileU first($columns = ['*'])
*/
class UserPersonalDataTSFileURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSFileU::class;
    }
}
