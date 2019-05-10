<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method PersonalDataTSGaleryDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryDelete find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryDelete first($columns = ['*'])
*/
class PersonalDataTSGaleryDeleteRepository extends BaseRepository
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
        return PersonalDataTSGaleryDelete::class;
    }
}
