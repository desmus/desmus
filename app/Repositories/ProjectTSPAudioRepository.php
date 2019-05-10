<?php

namespace App\Repositories;

use App\Models\ProjectTSPAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPAudioRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method ProjectTSPAudio findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPAudio find($id, $columns = ['*'])
 * @method ProjectTSPAudio first($columns = ['*'])
*/
class ProjectTSPAudioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'p_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPAudio::class;
    }
}
