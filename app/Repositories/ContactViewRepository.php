<?php

namespace App\Repositories;

use App\Models\ContactView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactViewRepository
 * @package App\Repositories
 * @version May 16, 2018, 11:03 pm UTC
 *
 * @method ContactView findWithoutFail($id, $columns = ['*'])
 * @method ContactView find($id, $columns = ['*'])
 * @method ContactView first($columns = ['*'])
*/
class ContactViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactView::class;
    }
}
