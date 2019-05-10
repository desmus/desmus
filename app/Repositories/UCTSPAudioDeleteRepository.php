<?php

namespace App\Repositories;

use App\Models\UCTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:40 pm UTC
 *
 * @method UCTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method UCTSPAudioDelete find($id, $columns = ['*'])
 * @method UCTSPAudioDelete first($columns = ['*'])
*/
class UCTSPAudioDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UCTSPAudioDelete::class;
    }
}
