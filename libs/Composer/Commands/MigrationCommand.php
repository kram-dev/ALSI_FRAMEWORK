<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Facades\DB;

class MigrationCommand extends Command
{
    protected $commandName = 'gen:migration';
    protected $commandDescription = "Create default migration";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "";  

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name    = strtolower($input->getArgument($this->commandArgumentName));
        

        if (!empty($input->getArgument($this->commandArgumentName))) {
            if(strpos($name, 'create_') !== false && strpos($name, '_table') !== false) {
                if (!file_exists("migration/$name.php")) {
                    $explode = explode('_', $name);
                    $migration_source_file = file_get_contents("libs/Composer/Source/Migration_Source_File.php", true);
                    $migration_file = fopen("migration/" . $name . ".php", 'w');
                    $replace_migration_class   = str_replace(['YourMigration', 'your_table'], ['Create' .ucfirst($explode[1]) . 'Table', $explode[1]], $migration_source_file);

                    fwrite($migration_file, $replace_migration_class);
                    $output->write("========================================================\n");
                    $output->writeln("--Success: migration/$name.php\n");
                } else { 
                    $output->write("========================================================\n");
                    $output->writeln("--Error: File exists\n");
                }
            }else {
                $output->write("========================================================\n");
                $output->write("--Error: Invalid Argument\n");
                $output->writeln("--Ex: create_users_table\n");
            }
        } else {
            $output->write("========================================================\n");
            $output->write("--Error: File[NULL]\n");
            $output->writeln("--Error: Class[NULL]\n");
        }
    }
}