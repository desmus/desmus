<?php

namespace App\Repositories;

use App\Models\ProjectTSPAudioCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPAudioCreateRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method ProjectTSPAudioCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPAudioCreate find($id, $columns = ['*'])
 * @method ProjectTSPAudioCreate first($columns = ['*'])
*/
class ProjectTSPAudioCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPAudioCreate::class;
    }
}
