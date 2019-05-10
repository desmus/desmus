<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalDataTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGalerie find($id, $columns = ['*'])
 * @method PersonalDataTSGalerie first($columns = ['*'])
*/
class PersonalDataTSGalerieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGalerie::class;
    }
}
