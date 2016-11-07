<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property \App\Model\Entity\User[] $users
 */
class Role extends Entity
{

}
