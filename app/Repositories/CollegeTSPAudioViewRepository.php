<?php

namespace App\Repositories;

use App\Models\CollegeTSPAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPAudioViewRepository
 * @package App\Repositories
 * @version July 1, 2018, 6:57 am UTC
 *
 * @method CollegeTSPAudioView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPAudioView find($id, $columns = ['*'])
 * @method CollegeTSPAudioView first($columns = ['*'])
*/
class CollegeTSPAudioViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPAudioView::class;
    }
}
