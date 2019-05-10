<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method PersonalDataTSToolDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolDelete find($id, $columns = ['*'])
 * @method PersonalDataTSToolDelete first($columns = ['*'])
*/
class PersonalDataTSToolDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolDelete::class;
    }
}
