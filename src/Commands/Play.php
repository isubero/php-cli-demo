<?php

namespace Isubero\PhpCliDemo\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'play',
    description: 'Play a simple math game'
)]
class Play extends Command
{
    /**
     * Execute the command
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $term1 = rand(1, 10);
        $term2 = rand(1, 10);
        $result = $term1 + $term2;

        $io = new SymfonyStyle($input, $output);

        $answer = (int) $io->ask(sprintf('What is %s + %s?', $term1, $term2));

        if ($answer === $result) {
            $io->success('Well done!');
        } else {
            $io->error(sprintf('Aww, so close. The answer was %s', $result));
        }

        if ($io->confirm('Play again?')) {
            return $this->execute($input, $output);
        }

        return Command::SUCCESS;
    }
}