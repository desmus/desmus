<?php

namespace App\Repositories;

use App\Models\PersonalDataTSFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method PersonalDataTSFileDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSFileDelete find($id, $columns = ['*'])
 * @method PersonalDataTSFileDelete first($columns = ['*'])
*/
class PersonalDataTSFileDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSFileDelete::class;
    }
}
