<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SessionCacheCommand extends Command
{
    protected $commandName = 'session:clear';
    protected $commandDescription = "Clear all session:cache";   

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);  

        foreach (glob('storage/session/*') as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
            unset($_SESSION);
              
        $output->write("======================================================\n");
        $io->success([
            '[SUCCESS]',
            'Your session is now empty.'
        ]);
        $output->writeln("======================================================\n");
    }
}