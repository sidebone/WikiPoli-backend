<?php

    
    namespace Helper;
    
    use Helper\Config as Config;

    class Database{

        public static function db_connect(){

            $all=Config::all_config();
            $con = mysqli_connect($all['DB_HOST'],$all['DB_USERNAME'],$all['DB_PASSWORD']);

            if (mysqli_connect_errno())
            {
                throw new Exception("Database is not connected".mysqli_connect_error());
            }else{

                return $con;
            }
        }

        public static function check_users($conn,$email){
            // $sql = "SELECT * FROM users WHERE email='".$email."'";
            $sql = "SELECT * FROM users";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_array($result);
                return $result;

            }else{
                return false;
            }
        }


        public static function register_user($conn,$email,$password,$name){

                $param="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".time();
                $letters = str_split($param);
                $str = "";
                for ($i=0; $i<=10; $i++) {
                    $str .= $letters[rand(0, count($letters)-1)];
                };
                

            $sql = "INSERT INTO users (user_id,name,email,password,admin,super_admin) VALUES ('$str', '$name', '$email','$password',0,0)";
            $result = mysqli_query($conn, $sql);

            if($result){

                return true;

            }else{
                return false;
            }
        }

        }
    
?>