<?php

namespace App\Repositories;

use App\Models\PDTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PDTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 1, 2018, 7:04 am UTC
 *
 * @method PDTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method PDTSPAudioUpdate find($id, $columns = ['*'])
 * @method PDTSPAudioUpdate first($columns = ['*'])
*/
class PDTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_d_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PDTSPAudioUpdate::class;
    }
}
