<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTSGaleryUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryUpdate first($columns = ['*'])
*/
class PersonalDataTSGaleryUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryUpdate::class;
    }
}
