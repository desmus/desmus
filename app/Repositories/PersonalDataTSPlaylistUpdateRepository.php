<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPlaylistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPlaylistUpdateRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:08 pm UTC
 *
 * @method PersonalDataTSPlaylistUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistUpdate find($id, $columns = ['*'])
 * @method PersonalDataTSPlaylistUpdate first($columns = ['*'])
*/
class PersonalDataTSPlaylistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPlaylistUpdate::class;
    }
}
