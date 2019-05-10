<?php

namespace App\Repositories;

use App\Models\UCTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:40 pm UTC
 *
 * @method UCTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method UCTSPAudioCreate find($id, $columns = ['*'])
 * @method UCTSPAudioCreate first($columns = ['*'])
*/
class UCTSPAudioCreateRepository extends BaseRepository
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
        return UCTSPAudioCreate::class;
    }
}
