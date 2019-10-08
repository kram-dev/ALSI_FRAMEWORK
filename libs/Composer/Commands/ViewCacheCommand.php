<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ViewCacheCommand extends Command
{
    protected $commandName = 'cache:clear';
    protected $commandDescription = "Clear all cache";   

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

        foreach (glob('storage/cache/*') as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        
        $output->write("======================================================\n");
        $io->success([
            '[SUCCESS]',
            'Your cache is now empty.'
        ]);
        $output->writeln("======================================================\n");
    }
}