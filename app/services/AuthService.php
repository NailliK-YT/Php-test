<?php
require_once '../app/trait/AuthTrait.php';
require_once '../app/repositories/UserRepository.php';
class AuthService {

    use AuthTrait;

    // Vérifie si les identifiants sont corrects
    public function login(string $email, string $password): bool {
        $userRepository = new UserRepository();

        $user = $userRepository->findByEmail($email);

        if($user !== null && $this->verify($password,$user->getPassword()))
        {
            if(session_status() == PHP_SESSION_NONE)
                session_start();
            $_SESSION['user'] = serialize($user);

            return true;
        }
        return false;
    }

    public function getUser()
    {
        if(session_status() == PHP_SESSION_NONE)
            session_start();
        return unserialize($_SESSION['user']);
    }

    public function logout() {
        // Logique pour déconnecter l'utilisateur
        // Par exemple, détruire la session
        session_destroy();
    }

    public function isLoggedIn(): bool {
        if(session_status() == PHP_SESSION_NONE)
            session_start();
        return isset($_SESSION['user']);
    }
}
