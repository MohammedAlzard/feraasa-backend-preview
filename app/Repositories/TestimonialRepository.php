<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Repositories\BaseRepository;

/**
 * Class TestimonialRepository
 * @package App\Repositories
 * @version September 4, 2022, 12:09 pm UTC
*/

class TestimonialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'name',
        'job',
        'description',
        'order_by',
        'is_active'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Testimonial::class;
    }
}
