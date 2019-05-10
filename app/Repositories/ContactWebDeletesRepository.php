<?php

namespace App\Repositories;

use App\Models\ContactWebDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactWebDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:45 pm UTC
 *
 * @method ContactWebDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactWebDeletes find($id, $columns = ['*'])
 * @method ContactWebDeletes first($columns = ['*'])
*/
class ContactWebDeletesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_web_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactWebDeletes::class;
    }
}
