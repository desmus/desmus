<?php

namespace App\Repositories;

use App\Models\PublicVideoCommentResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoCommentResponseRepository
 * @package App\Repositories
 * @version January 9, 2019, 11:10 pm UTC
 *
 * @method PublicVideoCommentResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicVideoCommentResponse find($id, $columns = ['*'])
 * @method PublicVideoCommentResponse first($columns = ['*'])
*/
class PublicVideoCommentResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_video_comment_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicVideoCommentResponse::class;
    }
}
