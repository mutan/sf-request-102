<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Api\SportsdataApiService;
use App\Service\Entity\NFLTeamManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * @var SportsdataApiService
     */
    private SportsdataApiService $sportsdataApiService;

    /**
     * @var NFLTeamManager
     */
    private NFLTeamManager $NFLTeamManager;

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct(NFLTeamManager $NFLTeamManager)
    {
        parent::__construct();
        $this->NFLTeamManager = $NFLTeamManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->NFLTeamManager->updateTeamListByApi();

        dd(123);

        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
