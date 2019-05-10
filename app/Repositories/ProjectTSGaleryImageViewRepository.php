<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryImageViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectTSGaleryImageView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryImageView find($id, $columns = ['*'])
 * @method ProjectTSGaleryImageView first($columns = ['*'])
*/
class ProjectTSGaleryImageViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryImageView::class;
    }
}
