<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSFileCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserPersonalDataTSFileC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSFileC find($id, $columns = ['*'])
 * @method UserPersonalDataTSFileC first($columns = ['*'])
*/
class UserPersonalDataTSFileCRepository extends BaseRepository
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
        return UserPersonalDataTSFileC::class;
    }
}
