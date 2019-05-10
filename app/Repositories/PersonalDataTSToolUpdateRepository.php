<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTSToolUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSToolUpdate first($columns = ['*'])
*/
class PersonalDataTSToolUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolUpdate::class;
    }
}
