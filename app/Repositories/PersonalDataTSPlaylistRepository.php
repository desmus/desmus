<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPlaylist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPlaylistRepository
 * @package App\Repositories
 * @version June 29, 2018, 7:07 pm UTC
 *
 * @method PersonalDataTSPlaylist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPlaylist find($id, $columns = ['*'])
 * @method PersonalDataTSPlaylist first($columns = ['*'])
*/
class PersonalDataTSPlaylistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'p_d_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPlaylist::class;
    }
}
