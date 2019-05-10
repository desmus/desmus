<?php

namespace App\Repositories;

use App\Models\UserPDTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPDTSPAudioRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UserPDTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method UserPDTSPAudio find($id, $columns = ['*'])
 * @method UserPDTSPAudio first($columns = ['*'])
*/
class UserPDTSPAudioRepository extends BaseRepository
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
        'p_d_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPDTSPAudio::class;
    }
}
