<?php

namespace App\Repositories;

use App\Models\UPTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UPTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method UPTSPAudioUpdate find($id, $columns = ['*'])
 * @method UPTSPAudioUpdate first($columns = ['*'])
*/
class UPTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UPTSPAudioUpdate::class;
    }
}
