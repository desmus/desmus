<?php

namespace App\Repositories;

use App\Models\PublicAudioCommentResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioCommentResponseRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicAudioCommentResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicAudioCommentResponse find($id, $columns = ['*'])
 * @method PublicAudioCommentResponse first($columns = ['*'])
*/
class PublicAudioCommentResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_audio_comment_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAudioCommentResponse::class;
    }
}
