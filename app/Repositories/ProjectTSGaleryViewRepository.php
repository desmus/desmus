<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectTSGaleryView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryView find($id, $columns = ['*'])
 * @method ProjectTSGaleryView first($columns = ['*'])
*/
class ProjectTSGaleryViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryView::class;
    }
}
