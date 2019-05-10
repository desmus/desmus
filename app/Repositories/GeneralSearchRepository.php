<?php

namespace App\Repositories;

use App\Models\GeneralSearch;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GeneralSearchRepository
 * @package App\Repositories
 * @version October 6, 2018, 12:17 am UTC
 *
 * @method GeneralSearch findWithoutFail($id, $columns = ['*'])
 * @method GeneralSearch find($id, $columns = ['*'])
 * @method GeneralSearch first($columns = ['*'])
*/
class GeneralSearchRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'search',
        'entity_type',
        'entity_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GeneralSearch::class;
    }
}
