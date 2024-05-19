<?php
declare(strict_types=1);
namespace App\Application\Actions\sender;





use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\classes\CreateLogger;
use App\Infrastructure\Persistence\User\RedisConn;
use App\Infrastructure\Persistence\User\Sql;


abstract class SenderAction extends Action
{

    public function __construct(LoggerInterface $logger, Sql $sql , RedisConn $redisConn, CreateLogger $createLogger)
    {
        parent::__construct($logger,$sql , $redisConn , $createLogger);
    }
}
