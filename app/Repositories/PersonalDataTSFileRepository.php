<?php

namespace App\Repositories;

use App\Models\PersonalDataTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalDataTSFile findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSFile find($id, $columns = ['*'])
 * @method PersonalDataTSFile first($columns = ['*'])
*/
class PersonalDataTSFileRepository extends BaseRepository
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
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSFile::class;
    }
}
