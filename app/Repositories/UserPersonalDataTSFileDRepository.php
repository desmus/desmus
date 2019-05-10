<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSFileD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSFileDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:04 pm UTC
 *
 * @method UserPersonalDataTSFileD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSFileD find($id, $columns = ['*'])
 * @method UserPersonalDataTSFileD first($columns = ['*'])
*/
class UserPersonalDataTSFileDRepository extends BaseRepository
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
        return UserPersonalDataTSFileD::class;
    }
}
