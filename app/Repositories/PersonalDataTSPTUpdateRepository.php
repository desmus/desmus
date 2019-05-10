<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPTUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPTUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method PersonalDataTSPTUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPTUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSPTUpdate first($columns = ['*'])
*/
class PersonalDataTSPTUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPTUpdate::class;
    }
}
