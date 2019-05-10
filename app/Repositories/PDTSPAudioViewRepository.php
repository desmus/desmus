<?php

namespace App\Repositories;

use App\Models\PDTSPAudioView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PDTSPAudioViewRepository
 * @package App\Repositories
 * @version July 1, 2018, 7:04 am UTC
 *
 * @method PDTSPAudioView findWithoutFail($id, $columns = ['*'])
 * @method PDTSPAudioView find($id, $columns = ['*'])
 * @method PDTSPAudioView first($columns = ['*'])
*/
class PDTSPAudioViewRepository extends BaseRepository
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
        return PDTSPAudioView::class;
    }
}
