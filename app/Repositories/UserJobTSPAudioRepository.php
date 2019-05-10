<?php

namespace App\Repositories;

use App\Models\UserJobTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSPAudioRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UserJobTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSPAudio find($id, $columns = ['*'])
 * @method UserJobTSPAudio first($columns = ['*'])
*/
class UserJobTSPAudioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'j_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSPAudio::class;
    }
}
