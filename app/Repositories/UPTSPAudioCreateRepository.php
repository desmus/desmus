<?php

namespace App\Repositories;

use App\Models\UPTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:41 pm UTC
 *
 * @method UPTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method UPTSPAudioCreate find($id, $columns = ['*'])
 * @method UPTSPAudioCreate first($columns = ['*'])
*/
class UPTSPAudioCreateRepository extends BaseRepository
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
        return UPTSPAudioCreate::class;
    }
}
