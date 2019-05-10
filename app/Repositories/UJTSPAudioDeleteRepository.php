<?php

namespace App\Repositories;

use App\Models\UJTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UJTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UJTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method UJTSPAudioDelete find($id, $columns = ['*'])
 * @method UJTSPAudioDelete first($columns = ['*'])
*/
class UJTSPAudioDeleteRepository extends BaseRepository
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
        return UJTSPAudioDelete::class;
    }
}
