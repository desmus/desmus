<?php

namespace App\Repositories;

use App\Models\PDTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PDTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 1, 2018, 7:04 am UTC
 *
 * @method PDTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method PDTSPAudioCreate find($id, $columns = ['*'])
 * @method PDTSPAudioCreate first($columns = ['*'])
*/
class PDTSPAudioCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PDTSPAudioCreate::class;
    }
}
