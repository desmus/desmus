<?php

namespace App\Repositories;

use App\Models\PublicAudioComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioCommentRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicAudioComment findWithoutFail($id, $columns = ['*'])
 * @method PublicAudioComment find($id, $columns = ['*'])
 * @method PublicAudioComment first($columns = ['*'])
*/
class PublicAudioCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
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
        return PublicAudioComment::class;
    }
}
