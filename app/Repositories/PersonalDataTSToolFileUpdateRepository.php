<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method PersonalDataTSToolFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolFileUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSToolFileUpdate first($columns = ['*'])
*/
class PersonalDataTSToolFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolFileUpdate::class;
    }
}
