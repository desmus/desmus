<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method PersonalDataTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolFile find($id, $columns = ['*'])
 * @method PersonalDataTSToolFile first($columns = ['*'])
*/
class PersonalDataTSToolFileRepository extends BaseRepository
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
        'personal_data_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolFile::class;
    }
}
