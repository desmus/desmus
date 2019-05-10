<?php

namespace App\Repositories;

use App\Models\UPTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UPTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method UPTSPAudioDelete find($id, $columns = ['*'])
 * @method UPTSPAudioDelete first($columns = ['*'])
*/
class UPTSPAudioDeleteRepository extends BaseRepository
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
        return UPTSPAudioDelete::class;
    }
}
