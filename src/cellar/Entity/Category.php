<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 08-06-2015
 * Time: 14:43
 */

namespace cellar\Entity;


class Category
{
    /**
     * @var integer $id
     * @ORM\Column(name="id",type="integer",nullable="false")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;
    /**
     * @var string $category_name
     * @ORM\Column(name="category_name",type="string",length="80",nullable="true")
     * */
    protected $category_name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

}