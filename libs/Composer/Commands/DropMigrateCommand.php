<?php
    
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Facades\DB;

class DropMigrateCommand extends Command
{
    protected $commandName = 'drop';
    protected $commandDescription = "Run the Migration";

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
        $name    = $input->getArgument($this->commandArgumentName);
        

        if (!empty($name)) {
            if (class_exists('Create' . ucfirst($name) . 'Table')) {
                $class = 'Create' . ucfirst($name) . 'Table';
                $migrate = new $class;
                 if (DB::schema()->hasTable(strtolower($name))) {
                    $migrate->drop();
                    $output->write("========================================================\n");
                    $output->writeln("--Success: Table[" . strtolower($name) . "] is now deleted.\n");
                 } else {
                    $output->write("========================================================\n");
                    $output->writeln("--Error: Table[" . strtolower($name) . "] is not exists.\n");
                 }
            } else {
                $output->write("========================================================\n");
                $output->write("--Error: Class[Create" . ucfirst($name) . "Table] not found.\n");
                $output->writeln("--Error: File[create_" . strtolower($name) . "_table] not found.\n");
            }
        } else {
            $output->write("========================================================\n");
            $output->write("--Error: File[NULL]\n");
            $output->writeln("--Error: Class[NULL]\n");
        }
    }
}