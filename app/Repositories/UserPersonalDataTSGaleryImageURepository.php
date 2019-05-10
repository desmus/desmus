<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGaleryImageU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGaleryImageURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserPersonalDataTSGaleryImageU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageU find($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageU first($columns = ['*'])
*/
class UserPersonalDataTSGaleryImageURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSGaleryImageU::class;
    }
}
