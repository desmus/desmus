<?php

namespace App\Repositories;

use App\Models\UserCollegeTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSPAudioRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:40 pm UTC
 *
 * @method UserCollegeTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSPAudio find($id, $columns = ['*'])
 * @method UserCollegeTSPAudio first($columns = ['*'])
*/
class UserCollegeTSPAudioRepository extends BaseRepository
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
        'c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSPAudio::class;
    }
}
