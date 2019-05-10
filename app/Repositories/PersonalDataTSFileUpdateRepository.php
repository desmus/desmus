<?php

namespace App\Repositories;

use App\Models\PersonalDataTSFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTSFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSFileUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSFileUpdate first($columns = ['*'])
*/
class PersonalDataTSFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSFileUpdate::class;
    }
}
