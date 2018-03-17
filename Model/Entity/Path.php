<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Path Entity
 *
 * @property int $id
 * @property string $name
 * @property int $starting_site_id
 * @property int $ending_site_id
 * @property float $max_capacity
 *
 * @property \App\Model\Entity\StartingSite $starting_site
 * @property \App\Model\Entity\EndingSite $ending_site
 */
class Path extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'starting_site_id' => true,
        'ending_site_id' => true,
        'max_capacity' => true,
        'starting_site' => true,
        'ending_site' => true
    ];
}
