<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ControllerCommand extends Command
{
    protected $commandName = 'gen:controller';
    protected $commandDescription = "Create default controller";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "";

    protected $commandOptionName = "m";
    protected $commandOptionDescription = '';    

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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = ucfirst($input->getArgument($this->commandArgumentName));

        if (!empty($input->getArgument($this->commandArgumentName))) {
            if(strpos($name, 'Controller') !== false) {
                if (!file_exists("app/Controller/$name.php")) {
                    $controller_source_file = file_get_contents("libs/Composer/Source/Controller_Source_File.php", true);
                    $controller_file = fopen("app/Controller/" . $name . ".php", 'w');
                    $replace_controller_class   = str_replace('YourController', $name, $controller_source_file);

                    if ($input->getOption($this->commandOptionName)) {
                        $model_name = str_replace('Controller', '', $name);
                        $model_source_file = file_get_contents("libs/Composer/Source/Model_Source_File.php", true);
                        $model_file = fopen("app/Model/" . $model_name . ".php", 'w');
                        $replace_model_class   = str_replace('YourModel', $model_name, $model_source_file);
                        fwrite($controller_file, $replace_controller_class);
                        fwrite($model_file, $replace_model_class);
                        $output->write("========================================================\n");
                        $output->write("--Success: app/Controller/$name.php\n");
                        $output->writeln("--Success: app/Model/$model_name.php\n");
                    } else {
                        fwrite($controller_file, $replace_controller_class);
                        $output->write("========================================================\n");
                        $output->writeln("--Success: app/Controller/$name.php\n");
                    }

                } else {
                    $output->write("========================================================\n");
                    $output->writeln("--Error: File exists\n");
                }
            } else {
                $output->write("========================================================\n");
                $output->write("--Error: Invalid Argument\n");
                $output->writeln("--Ex: UserController\n");
            }
        } else {
            $output->write("========================================================\n");
            $output->write("--Error: File[NULL]\n");
            $output->writeln("--Error: Class[NULL]\n");
        }
    }
}