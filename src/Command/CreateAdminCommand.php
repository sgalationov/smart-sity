<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    protected $passwordEncoder;
    protected $em;

    public function __construct(string $name = null, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        parent::__construct($name);
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create admin with 2 parameters: login and password')
            ->addArgument('arg1', InputArgument::REQUIRED, 'Login admin')
            ->addArgument('arg2', InputArgument::REQUIRED, 'Password admin')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $arg2 = $input->getArgument('arg2');
        $user = new User();
        $user->setLogin($arg1);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $arg2));
        $user->setRoles(['ROLE_ADMIN']);
        $this->em->persist($user);
        $this->em->flush();
        $io->success('Admin created!');
    }
}
