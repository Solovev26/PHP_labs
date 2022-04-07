<?php
require_once './User.php';

class Comment
{
    private User $_user;
    private string $_msg;

    public function __construct(User $user, string $msg)
    {
        $this->_user = $user;
        $this->_msg = $msg;
    }
    
    public function getMsg(): string
    {
        return $this->_msg;
    }

    public function getUser(): User
    {
        return $this->_user;
    }

}