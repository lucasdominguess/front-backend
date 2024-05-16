<?php
declare(strict_types=1);
namespace App\Application\Actions\Token;




use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;

abstract class TokenAction extends Action
{

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}
