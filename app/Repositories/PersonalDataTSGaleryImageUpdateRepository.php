<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryImageUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method PersonalDataTSGaleryImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageUpdate first($columns = ['*'])
*/
class PersonalDataTSGaleryImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryImageUpdate::class;
    }
}
