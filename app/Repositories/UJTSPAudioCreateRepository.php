<?php

namespace App\Repositories;

use App\Models\UJTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UJTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UJTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method UJTSPAudioCreate find($id, $columns = ['*'])
 * @method UJTSPAudioCreate first($columns = ['*'])
*/
class UJTSPAudioCreateRepository extends BaseRepository
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
        return UJTSPAudioCreate::class;
    }
}
