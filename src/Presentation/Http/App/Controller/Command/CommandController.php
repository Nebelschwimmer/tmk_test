<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Controller\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

class CommandController extends AbstractController
{

    #[Route('/seed', name: 'db_seed')]
    public function seed(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'doctrine:fixtures:load',
            '--purge-with-truncate' => true,
            '--no-interaction' => true
        ]);

        $output = new BufferedOutput();
        $application->run($input, $output);
        
        return $this->redirect($this->generateUrl('app_frontpage'));
    }
}