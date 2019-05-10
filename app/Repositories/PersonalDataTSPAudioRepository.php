<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPAudioRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:58 am UTC
 *
 * @method PersonalDataTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPAudio find($id, $columns = ['*'])
 * @method PersonalDataTSPAudio first($columns = ['*'])
*/
class PersonalDataTSPAudioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPAudio::class;
    }
}
