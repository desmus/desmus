<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGaleryImageD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGaleryImageDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:08 pm UTC
 *
 * @method UserPersonalDataTSGaleryImageD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageD find($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageD first($columns = ['*'])
*/
class UserPersonalDataTSGaleryImageDRepository extends BaseRepository
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
        return UserPersonalDataTSGaleryImageD::class;
    }
}
