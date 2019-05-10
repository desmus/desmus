<?php

namespace App\Repositories;

use App\Models\PDTSPAudioDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PDTSPAudioDeleteRepository
 * @package App\Repositories
 * @version July 1, 2018, 7:06 am UTC
 *
 * @method PDTSPAudioDelete findWithoutFail($id, $columns = ['*'])
 * @method PDTSPAudioDelete find($id, $columns = ['*'])
 * @method PDTSPAudioDelete first($columns = ['*'])
*/
class PDTSPAudioDeleteRepository extends BaseRepository
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
        return PDTSPAudioDelete::class;
    }
}
