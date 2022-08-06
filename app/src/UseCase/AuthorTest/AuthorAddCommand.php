<?php

declare(strict_types=1);

namespace App\UseCase\AuthorTest;

use App\Domain\Authors\Core\AuthorFactoryInterface;
use App\Domain\Authors\Core\AuthorRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class AuthorAddCommand extends Command
{
    protected static $defaultName = 'app:author:add';

    private AuthorFactoryInterface $authorFactory;
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorFactoryInterface $authorFactory, AuthorRepositoryInterface $authorRepository)
    {
        parent::__construct();
        $this->authorFactory = $authorFactory;
        $this->authorRepository = $authorRepository;
    }

    protected function configure(): void
    {
        $this
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Display name of the author')
            ->addOption('email', null, InputOption::VALUE_REQUIRED, 'E-mail of the author');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            /** @var string $name */
            $name = $input->getOption('name');

            /** @var string $email */
            $email = $input->getOption('email');

            $author = ($this->authorFactory)($name, $email);
        } catch (\Exception $exception) {
            $io->error(\sprintf('Error when creating the author: %s', $exception->getMessage()));

            return self::INVALID;
        }

        $table = $io->createTable();
        $table->setHeaderTitle('Authors to persist');
        $table->setHeaders(['ID', 'E-mail', 'Display name']);
        $table->addRow([$author->getIdentifier(), $author->getEmail(), $author->getDisplayName()]);
        $table->render();

        $this->authorRepository->add($author);

        return self::SUCCESS;
    }
}
