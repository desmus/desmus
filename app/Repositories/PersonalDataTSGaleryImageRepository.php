<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method PersonalDataTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImage find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryImage first($columns = ['*'])
*/
class PersonalDataTSGaleryImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'personal_data_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryImage::class;
    }
}
