<?php

namespace App\Repositories;

use App\Models\PublicImageCommentResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageCommentResponseRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicImageCommentResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicImageCommentResponse find($id, $columns = ['*'])
 * @method PublicImageCommentResponse first($columns = ['*'])
*/
class PublicImageCommentResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_image_comment_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicImageCommentResponse::class;
    }
}
