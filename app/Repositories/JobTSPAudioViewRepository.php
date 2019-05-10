<?php

namespace App\Repositories;

use App\Models\JobTSPAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPAudioViewRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method JobTSPAudioView findWithoutFail($id, $columns = ['*'])
 * @method JobTSPAudioView find($id, $columns = ['*'])
 * @method JobTSPAudioView first($columns = ['*'])
*/
class JobTSPAudioViewRepository extends BaseRepository
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
        return JobTSPAudioView::class;
    }
}
