<?php

namespace App\Repositories;

use App\Models\PublicAudioLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicAudioLike findWithoutFail($id, $columns = ['*'])
 * @method PublicAudioLike find($id, $columns = ['*'])
 * @method PublicAudioLike first($columns = ['*'])
*/
class PublicAudioLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_audio_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAudioLike::class;
    }
}
