<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ModelCommand extends Command
{
    protected $commandName = 'gen:model';
    protected $commandDescription = "Create default model";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "";

    protected $commandOptionName = "m";
    protected $commandOptionDescription = "";
    protected $commandSecondOptionName = "c";
    protected $commandSecondOptionDescription = "";     

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
            ->addOption(
               $this->commandOptionName,
               null,
               InputOption::VALUE_NONE,
               $this->commandOptionDescription
            )
            ->addOption(
                $this->commandSecondOptionName,
                null,
                InputOption::VALUE_NONE,
                $this->commandSecondOptionDescription
             )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = ucfirst($input->getArgument($this->commandArgumentName));

        // if (!empty($input->getArgument($this->commandArgumentName))) {
            // if (!file_exists("app/Model/$name.php")) {
            //     $model_source_file = file_get_contents("libs/Composer/Source/Model_Source_File.php", true);
            //     $model_file = fopen("app/Model/" . $name . ".php", 'w');
            //     $replace_model_class   = str_replace('YourModel', $name, $model_source_file);
                
                if ($input->getOption($this->commandSecondOptionName)) {
                    echo $name . '<br>';
                    echo 'c';
                    // $migration_name = 'create_' . lcfirst($name) . 's_table';
                    // $migration_source_file = file_get_contents("libs/Composer/Source/Migration_Source_File.php", true);
                    // $migration_file = fopen("migration/" . $migration_name . ".php", 'w');
                    // $replace_migration_class   = str_replace(['YourMigration', 'your_table'], ['Create' . $name . 'sTable', lcfirst($name) .'s'], $migration_source_file);
                    // fwrite($model_file, $replace_model_class);
                    // fwrite($migration_file, $replace_migration_class);
                    // $output->write("========================================================\n");
                    // $output->write("--Success: app/Model/$name.php\n");
                    // $output->writeln("--Success: migration/$migration_name.php\n");
                } else {
                    // fwrite($model_file, $replace_model_class);
                    // $output->write("========================================================\n");
                    // $output->writeln("--Success: app/Model/$name.php\n");
                }

            // } else { 
            //     $output->write("========================================================\n");
            //     $output->writeln("--Error: File exists\n");
            // }
        // } else {
        //     $output->write("========================================================\n");
        //     $output->write("--Error: File[NULL]\n");
        //     $output->writeln("--Error: Class[NULL]\n");
        // }
    }
}