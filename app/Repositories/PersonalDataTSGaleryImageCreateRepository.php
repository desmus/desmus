<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryImageCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryImageCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataTSGaleryImageCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageCreate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageCreate first($columns = ['*'])
*/
class PersonalDataTSGaleryImageCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryImageCreate::class;
    }
}
