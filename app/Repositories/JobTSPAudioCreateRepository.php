<?php

namespace App\Repositories;

use App\Models\JobTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method JobTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPAudioCreate find($id, $columns = ['*'])
 * @method JobTSPAudioCreate first($columns = ['*'])
*/
class JobTSPAudioCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPAudioCreate::class;
    }
}
