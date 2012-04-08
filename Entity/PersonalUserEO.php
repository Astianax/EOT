<?php
include './DB/Connection.php';

class PersonalUser
{
    public $id;
    public $name;
    public $lastName;
    public $email;
    public $birthday;
    public $password;
    public $gender;
    public $nationality;
    public $currentCity;
    public $homeTown;
    public $aboutMe;
    public $relationshipStat;
    public $telephoneNum;
    public $address;
    public $neighborhood;
    public $webSite;
    public $photoId;
    public $religion;
    public $religionDescrip;
    public $inspiration;
    public $inspirationDescrip;
    public $music;
    public $books;
    public $television;
    public $games;
    public $visitedPlaces;
    public $sports;
    public $sportGamers;
    public $sporTeam;
    public $alteEmails;
    public $activities;
    public $interest;
    public $userName;
    public $authenticated;
    
    public function __construct(){
        $connection = Connection::getInstance();
    }
    function authenticateUser($email="", $password=""){
        $this->authenticated=false;
        $this->email= mysql_real_escape_string($email);
        $this->password= mysql_real_escape_string($password);
        $sql="SELECT email, password FROM `PersonalUser` WHERE `email`='{$email}' AND `password`=md5('{$password}')";
        $rs=mysql_query($sql);

        if(mysql_num_rows($rs)==1){
 
        if (!$rs){
               header("Location:./");
            }
//        if(mysql_num_rows($rs)==1){

            if(mysql_num_rows($rs)>=1){

                $row=mysql_fetch_assoc($rs);
                $this->email=$row['email'];
                $this->password=$row['password'];
                $this->id=$row['id'];
                $this->authenticated=true;     
            }else{
            }
        }
       }  
       function save()
        {
        if($this->id==0)
        {
                $sql="INSERT INTO `PersonalUser`(
                `name`,
                `lastName`,
                `email`,
                `birthday`,
                `password`,
                `gender`,
                `nationality`,
                `currentCity`,
                `homeTown`,
                `aboutMe`,
                `relationshipStat`,
                `telephoneNum`,
                `address`,
                `neighborhood`,
                `webSite`,
                `photoId`,
                `religion`,
                `religionDescrip`,
                `inspiration`,
                `inspirationDescrip`,
                `music`,
                `books`,
                `television`,
                `games`,
                `visitedPlaces`,
                `sports`,
                `sportGamers`,
                `sporTeam`,
                `alteEmails`,
                `activities`,
                `interest`,
                `userName`
                )VALUES(
                    '{$this->name}',
                    '{$this->lastName}',
                    '{$this->email}',
                    '{$this->birthday}',
            md5 ('{$this->password}'),
                    '{$this->gender}',
                    '{$this->nationality}',
                    '{$this->currentCity}',
                    '{$this->homeTown}',
                    '{$this->aboutMe}',
                    '{$this->relationshipStat}',
                    '{$this->telephoneNum}',
                    '{$this->address}',
                    '{$this->neighborhood}',
                    '{$this->webSite}',
                    '{$this->photoId}',
                    '{$this->religion}',
                    '{$this->religionDescrip}',
                    '{$this->inspiration}',
                    '{$this->inspirationDescrip}',
                    '{$this->music}',
                    '{$this->books}',
                    '{$this->television}',
                    '{$this->games}',
                    '{$this->visitedPlaces}',
                    '{$this->sports}',
                    '{$this->sportGamers}',
                    '{$this->sporTeam}',
                    '{$this->alteEmails}',
                    '{$this->activities}',
                    '{$this->interest}',
                    '{$this->userName}')";
                    mysql_query($sql);
                      $this->id=mysql_insert_id();
            }else
            {
                    $sql="UPDATE PersonalUser
                    SET `name`='{$this->name}',
                            `lastName`='{$this->lastName}',
                            `email`='{$this->email}',
                            `birthday`='{$this->birthday}',
                            `password`= md5('{$this->password}'),
                            `gender`='{$this->gender}',
                            `nationality`='{$this->nationality}',
                            `currentCity`='{$this->currentCity}',
                            `homeTown`='{$this->homeTown}',
                            `aboutMe`='{$this->aboutMe}',
                            `relationshipStat`='{$this->relationshipStat}',
                            `telephoneNum`='{$this->telephoneNum}',
                            `address`='{$this->address}',
                            `neighborhood`='{$this->neighborhood}',
                            `webSite`='{$this->webSite}',
                            `photoId`='{$this->photoId}',
                            `religion`='{$this->religion}',
                            `religionDescrip`='{$this->religionDescrip}',
                            `inspiration`='{$this->inspiration}',
                            `inspirationDescrip`='{$this->inspirationDescrip}',
                            `music`='{$this->music}',
                            `books`='{$this->books}',
                            `television`='{$this->television}',
                            `games`='{$this->games}',
                            `visitedPlaces`='{$this->visitedPlaces}',
                            `lastName`='{$this->lastName}',
                            `sports`='{$this->sports}',
                            `sportGamers`='{$this->sportGamers}',
                            `sporTeam`='{$this->sporTeam}',
                            `alteEmails`='{$this->alteEmails}',
                            `activities`='{$this->activities}',
                            `interest`='{$this->interest}',
                            `userName`='{$this->userName}'
                            where `id`='{$this->id}'";
                            mysql_query($sql);               
                }
            }
 }
