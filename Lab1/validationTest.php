<?php
require_once './vendor/autoload.php';
require_once './User.php';

use Symfony\Component\Validator\Constraints\{Length, NotBlank};
use Symfony\Component\Validator\Validation;

$validator = Validation::createValidator();
$violations = $validator->validate('Bernhard', [
    new Length(['min' => 10]),
    new NotBlank(),
]);

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $violation) {
        echo $violation->getMessage().'<br>';
    }
}

//Wrong user.
$u1 = new User('a', 'a', 'a');
$u1->echoPrint();
echo $u1->getCreationDateTime() . '<br>';

echo '<br>';

//Good user.
$us2 = new User('u8191080', 'solovev26.ru@gmail.com', 'My_Pass123@');
$us2->echoPrint();
echo $us2->getCreationDateTime() . '<br>';
