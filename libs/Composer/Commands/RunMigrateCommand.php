<?php
    
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Illuminate\Database\Capsule\Manager as DB;

class RunMigrateCommand extends Command
{
    protected $commandName = 'migrate';
    protected $commandDescription = "Run the Migration";

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

        $count_mirgated_table = 0;
        $success_table = [];

        foreach(glob('migration/*.php') as $migrate){
            require $migrate;
            $explode_file  = explode('/', $migrate);
            $explode_table = explode('_', $explode_file[1]);

            if (class_exists('Create'.ucfirst($explode_table[1]).'Table')) {
                if (!DB::schema()->hasTable(strtolower($explode_table[1]))) {
                    $class = 'Create' . ucfirst($explode_table[1]) . 'Table';
                    $object = new $class;
                    $object->create();
                    $success_table[] = 'create_' . $explode_table[1] . '_table.php';
                    $count_mirgated_table++;
                }
            }
        }
            if ($count_mirgated_table >= 1) {
                $output->write("======================================================\n");
                $io->success([
                    '[SUCCESS]',
                ]);
                foreach ($success_table as $migrated) {
                    $output->writeln("\t* $migrated");
                }
                $output->writeln("\n======================================================\n");
            } else {
                $output->write("======================================================\n");
                $io->error([
                    '[FAIL]',
                    'Nothing to migrate.'
                ]);
                $output->writeln("======================================================\n");
            }
    }
}