<?php

namespace App\Repositories;

use App\Models\PublicImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicImageViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:46 am UTC
 *
 * @method PublicImageView findWithoutFail($id, $columns = ['*'])
 * @method PublicImageView find($id, $columns = ['*'])
 * @method PublicImageView first($columns = ['*'])
*/
class PublicImageViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicImageView::class;
    }
}
