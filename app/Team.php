<?php

namespace App;

use Laravel\Spark\Teams\Team as SparkTeam;
use OwenIt\Auditing\AuditingTrait;

class Team extends SparkTeam
{
    use AuditingTrait;

    protected $with = 'owner'; // <- SparkTeam

    /**
     * Log custom message
     */
    public static $logCustomMessage = '{user.name|Anonymous} {type} a team {elapsed_time}';

    /**
     * Log custom fields message
     */
    public static $logCustomFields = [
        'name'  => 'The name was defined as {new.name}',
        'owner_id' => [
            'updated' => '{||ownerName} owns the team',
            'created' => '{owner.owner.name} was defined as owner'
        ],
    ];

    /**
     * @param $log
     * @return string
     */
    public function ownerName($log)
    {
        return $log->owner->owner->name;
    }

}

