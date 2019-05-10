<?php

namespace App\Repositories;

use App\Models\UJTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UJTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UJTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method UJTSPAudioUpdate find($id, $columns = ['*'])
 * @method UJTSPAudioUpdate first($columns = ['*'])
*/
class UJTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_j_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UJTSPAudioUpdate::class;
    }
}
