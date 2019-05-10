<?php

namespace App\Repositories;

use App\Models\UPDTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPDTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:42 pm UTC
 *
 * @method UPDTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method UPDTSPAudioUpdate find($id, $columns = ['*'])
 * @method UPDTSPAudioUpdate first($columns = ['*'])
*/
class UPDTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UPDTSPAudioUpdate::class;
    }
}
