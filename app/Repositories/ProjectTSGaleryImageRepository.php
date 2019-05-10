<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method ProjectTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryImage find($id, $columns = ['*'])
 * @method ProjectTSGaleryImage first($columns = ['*'])
*/
class ProjectTSGaleryImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'project_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryImage::class;
    }
}
