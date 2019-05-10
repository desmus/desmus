<?php

namespace App\Repositories;

use App\Models\UCTSPAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UCTSPAudioUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 7:40 pm UTC
 *
 * @method UCTSPAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method UCTSPAudioUpdate find($id, $columns = ['*'])
 * @method UCTSPAudioUpdate first($columns = ['*'])
*/
class UCTSPAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_c_t_s_p_a_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UCTSPAudioUpdate::class;
    }
}
