<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTSGaleryCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryCreate find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryCreate first($columns = ['*'])
*/
class PersonalDataTSGaleryCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_d_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryCreate::class;
    }
}
