<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

class UserPromoteCommand extends Command
{
    protected static $defaultDescription = 'Add a short description for your command';
    protected static $defaultName = 'app:user:promote';
    private $om;

    public function __construct(EntityManagerInterface $paraOm)
    {
        $this->om = $paraOm;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Promote a user by adding him a new roles.')
            ->addArgument('username', InputArgument::REQUIRED, 'username of the user you want to promote.')
            ->addArgument('roles', InputArgument::REQUIRED, 'The roles you want to add to
    the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $roles = $input->getArgument('roles');
        $userRepository = $this->om->getRepository(User::class);
        $user = $userRepository->findOneBy(['username' => $username]);
        if ($user) {
            $user->addRoles($roles);
            $this->om->flush();
            $io->success('The roles has been successfully added to the user.
    ');
        } else {
            $io->error('There is no user with that username.');
        }
        return 0;
    }
}
