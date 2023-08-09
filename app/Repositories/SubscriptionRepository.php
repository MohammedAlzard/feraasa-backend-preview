<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Repositories\BaseRepository;

/**
 * Class SubscriptionRepository
 * @package App\Repositories
 * @version October 2, 2022, 11:12 am UTC
*/

class SubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'service_id',
        'is_active',
        'count',
        'count_used',
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at'
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
        return Subscription::class;
    }
}
