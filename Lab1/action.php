<?php
require_once './User.php';
require_once './Comment.php';

$sentComment = [];

for ($i = 1; $i < 4; $i++) {
    $user = new User("u8191080", 'solovev26.ru@gmail.com', 'My_Pass123');
    $userId = $user->getId(); 
    $sentComment[$i] = new Comment($user, "Comment number - #$i from user - $userId");
    sleep(1);
}

$date = new DateTime("November 9, 2012, 9:20 am");
$printDate = $date->format("F j, Y, g:i a");

echo "Entered date: $printDate<br>";

foreach ($sentComment as $comment) {
    if (strtotime($comment->getUser()->getCreationDateTime()) > $date->getTimestamp())
        echo $comment->getMsg() . ' user time:' . $comment->getUser()->getCreationDateTime() . '<br>';
}