<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28/07/2019
 * Time: 18:19
 */

namespace App\Helper;


interface AuthorInterface
{
    public function setAuthor($user);
    public function getAuthor();
    public function setCreatedAt($createdAt);
    public function getCreatedAt();
}