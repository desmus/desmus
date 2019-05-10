<?php

namespace App\Repositories;

use App\Models\PublicAudioUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicAudioUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicAudioUpdate find($id, $columns = ['*'])
 * @method PublicAudioUpdate first($columns = ['*'])
*/
class PublicAudioUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_audio_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAudioUpdate::class;
    }
}
