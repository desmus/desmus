<?php

namespace App\Repositories;

use App\Models\ProjectTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:58 am UTC
 *
 * @method ProjectTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPAudioDelete find($id, $columns = ['*'])
 * @method ProjectTSPAudioDelete first($columns = ['*'])
*/
class ProjectTSPAudioDeleteRepository extends BaseRepository
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
        return ProjectTSPAudioDelete::class;
    }
}
