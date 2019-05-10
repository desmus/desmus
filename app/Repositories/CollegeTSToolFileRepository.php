<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method CollegeTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFile find($id, $columns = ['*'])
 * @method CollegeTSToolFile first($columns = ['*'])
*/
class CollegeTSToolFileRepository extends BaseRepository
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
        'college_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFile::class;
    }
}
