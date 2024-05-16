<?php
namespace App\Application\Extension;
use Slim\Csrf\Guard;
use Twig\Extension\GlobalsInterface;

class CsrfExtension extends \Twig\Extension\AbstractExtension implements GlobalsInterface
{
    /**
     * @var Guard
     */
    

    public function __construct(protected Guard $csrf)
    {
        
    }

    public function getGlobals():array
    {
        // CSRF token name and value
        $csrfNameKey = $this->csrf->getTokenNameKey();
        $csrfValueKey = $this->csrf->getTokenValueKey();
        $csrfName = $this->csrf->getTokenName();
        $csrfValue = $this->csrf->getTokenValue();

        return [
            'csrf' => [
                'keys' => [
                    'name' => $csrfNameKey,
                    'value' => $csrfValueKey
                ],
                'name' => $csrfName,
                'value' => $csrfValue
            ]
        ];
    }
}