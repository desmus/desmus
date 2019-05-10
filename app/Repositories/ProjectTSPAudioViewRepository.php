<?php

namespace App\Repositories;

use App\Models\ProjectTSPAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPAudioViewRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method ProjectTSPAudioView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPAudioView find($id, $columns = ['*'])
 * @method ProjectTSPAudioView first($columns = ['*'])
*/
class ProjectTSPAudioViewRepository extends BaseRepository
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
        return ProjectTSPAudioView::class;
    }
}
