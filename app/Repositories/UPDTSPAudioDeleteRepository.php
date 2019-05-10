<?php

namespace App\Repositories;

use App\Models\UPDTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPDTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:49 pm UTC
 *
 * @method UPDTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method UPDTSPAudioDelete find($id, $columns = ['*'])
 * @method UPDTSPAudioDelete first($columns = ['*'])
*/
class UPDTSPAudioDeleteRepository extends BaseRepository
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
        return UPDTSPAudioDelete::class;
    }
}
