<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryImageDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryImageDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method PersonalDataTSGaleryImageDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageDelete find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImageDelete first($columns = ['*'])
*/
class PersonalDataTSGaleryImageDeleteRepository extends BaseRepository
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
        return PersonalDataTSGaleryImageDelete::class;
    }
}
