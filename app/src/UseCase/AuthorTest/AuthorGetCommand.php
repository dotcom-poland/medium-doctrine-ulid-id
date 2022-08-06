<?php

declare(strict_types=1);

namespace App\UseCase\AuthorTest;

use App\Domain\Authors\Core\AuthorRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class AuthorGetCommand extends Command
{
    protected static $defaultName = 'app:author:get';

    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        parent::__construct();
        $this->authorRepository = $authorRepository;
    }

    protected function configure(): void
    {
        $this->addOption('email', null, InputOption::VALUE_REQUIRED, 'Get author by e-mail');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var string $email */
        $email = $input->getOption('email');

        $author = $this->authorRepository->findByEmail($email);

        if (null === $author) {
            $io->error(\sprintf('Author by e-mail "%s" not found', $email));

            return self::SUCCESS;
        }

        $table = $io->createTable();
        $table->setHeaderTitle('Authors found');
        $table->setHeaders(['ID', 'E-mail', 'Display name']);
        $table->addRow([$author->getIdentifier(), $author->getEmail(), $author->getDisplayName()]);
        $table->render();

        return self::SUCCESS;
    }
}
