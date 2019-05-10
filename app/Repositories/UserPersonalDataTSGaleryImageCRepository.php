<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGaleryImageC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGaleryImageCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserPersonalDataTSGaleryImageC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageC find($id, $columns = ['*'])
 * @method UserPersonalDataTSGaleryImageC first($columns = ['*'])
*/
class UserPersonalDataTSGaleryImageCRepository extends BaseRepository
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
        return UserPersonalDataTSGaleryImageC::class;
    }
}
