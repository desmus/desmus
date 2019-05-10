<?php

namespace App\Repositories;

use App\Models\UPDTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UPDTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:42 pm UTC
 *
 * @method UPDTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method UPDTSPAudioCreate find($id, $columns = ['*'])
 * @method UPDTSPAudioCreate first($columns = ['*'])
*/
class UPDTSPAudioCreateRepository extends BaseRepository
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
        return UPDTSPAudioCreate::class;
    }
}
