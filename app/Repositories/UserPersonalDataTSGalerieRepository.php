<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerie find($id, $columns = ['*'])
 * @method UserPersonalDataTSGalerie first($columns = ['*'])
*/
class UserPersonalDataTSGalerieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'personal_data_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSGalerie::class;
    }
}
