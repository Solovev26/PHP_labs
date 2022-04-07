<?php
require_once './vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Constraints\{Length, NotBlank, Email, Regex};

echo "<link rel='stylesheet' href='style.css'>";
class User
{
    private string $_id;
    private string $_email;
    private string $_password;
    private string $_timeConstruct;

    public function __construct(string $id, string $email, string $password)
    {
        $this->_timeConstruct = date("F j, Y, g:i a");

        $violations = $this->validateId($id);
        $this->validationErrorReport($violations, 'Invalid user id');

        $violations = $this->validatePassword($password);
        $this->validationErrorReport($violations, 'Invalid user pass');

        $violations = $this->validateEmail($email);
        $this->validationErrorReport($violations, 'Invalid mail');

        $this->_id = $id;
        $this->_password = $password;
        $this->_email = $email;

    }

    public function getCreationDateTime(): string
    {
        return $this->_timeConstruct;
    }

    public function getId(): string
    {
        return $this->_id;
    }

    public function echoPrint(): void
    {
        echo "Id: $this->_id<br>";
        echo "mail: $this->_email<br>";
        echo "Password: $this->_password<br>";
    }

    private function validationErrorReport(ConstraintViolationListInterface $violations, string $title): void
    {
        if (count($violations) <= 0)
            return;
        echo '<h3>' . $title . '</h3>';
        foreach ($violations as $violation) {
            echo $violation->getMessage().'<br>';
        }
        echo '<br>';

    }

    private function validatePassword(string $password): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($password, [
            new NotBlank(),
            new Length(['min'=>7]),
            new Regex(['pattern' => '/[a-zA-Z0-9_\-.]+/',]),
        ]);
    }
    private function validateId(string $id): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($id, [
            new NotBlank(),
            new Regex(['pattern' => '/u[0-9]{1,7}/',]),
        ]);
    }

    private function validateEmail(string $email): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($email, [
            new NotBlank(),
            new Regex(['pattern' => '/[[a-zA-Z0-9_\-.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-.]+/',]),
        ]);
    }


}