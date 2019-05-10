<?php

namespace App\Repositories;

use App\Models\UserProjectTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSPAudioRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UserProjectTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSPAudio find($id, $columns = ['*'])
 * @method UserProjectTSPAudio first($columns = ['*'])
*/
class UserProjectTSPAudioRepository extends BaseRepository
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
        'p_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSPAudio::class;
    }
}
