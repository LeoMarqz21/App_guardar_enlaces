<?php 

class ConnectionDB{

    //database connection
    private $server = "localhost";
    private $user_name = "root";
    private $password = "";
    private $database = "links";

    //database connection result
    private $my_connection = null;

    //login information
    public $my_name = "";
    public $my_password = "";
    public $my_user_id = "";

    //methods to open the connection to the data base
    public function Open()
    {
        @$this->my_connection = mYsqli_connect($this->server, $this->user_name, $this->password, $this->database);
        if(mysqli_connect_errno()){ die("Error connecting to the database"); } //else{ echo "Excelent"; }
    }

    public function Close(){ @mysqli_close($this->my_connection); }

    //methods of login and register
    public function Login()
    {
        $this->Open();
        if($this->my_name != '' && $this->my_password != ''){
            $query = "SELECT id_user FROM users WHERE user_name='" .$this->my_name . "' AND user_password='" . MD5($this->my_password) . "'";
            $result = mysqli_query($this->my_connection, $query);
            if(mysqli_num_rows($result) == 1){
                while($data = mysqli_fetch_array($result)){
                    $this->my_user_id = $data['id_user'];
                    $this->Close();
                    return true;
                }
            }
            else{
                $this->Close();
                return false;
            }
        }else{
            $this->Close();
            return false;
        }
    }
    
    public function Register($full_name, $user_name, $user_password)
    {
        $this->Open();
        if($full_name != '' && $user_name != '' && $user_password != ''){

            $query1 = "SELECT * FROM users WHERE user_name='" . $user_name . "'";
            $check = mysqli_query($this->my_connection, $query1);
            if(mysqli_num_rows($check) == 1){
                echo "<script> alert('Ya existe un usuario con ese nombre'); </script>";
                $this->Close();
                return false;
            }else{
                $query2 = "INSERT INTO users (name, user_name, user_password) VALUES ('" . $full_name . "','" . $user_name . "','" . MD5($user_password) . "')";
                mysqli_query($this->my_connection, $query2);
                $this->Close();
                return true;
            }

        }else{
            $this->Close();
            echo "<script> alert('Los Campos no pueden quedar vacios'); </script>";
            return false;
        }
    }

    public function GetName($user_id)
    {
        $this->Open();
        $query = "SELECT name FROM users WHERE id_user='" . $user_id . "'";
        $result = mysqli_query($this->my_connection, $query);
        if(mysqli_num_rows($result) == 1){
            while($rs = mysqli_fetch_array($result)){
                $this->Close();
                return $rs['name'];
            }
        }
    }

    //https://qastack.mx/superuser/1146472/how-to-open-a-page-in-incognito-mode-from-html 
    //mode private

    //methods to add and remove links
    public function AddLink($user_id, $title, $link, $incognito_mode = false)
    {
        $this->Open();
        if($title != '' && $link != ''){

            $query = "INSER INTO my_links (id_user,title, link, incognite_mode) VALUES ('" . $user_id ."','" . $title . "','" . $link . "','" . $incognito_mode . "')";
            mysqli_query($this->my_connection, $query);
            echo "<script> alert('Enlace guardado'); </script>";
        
        }else{
            echo "<script> alert('ingrese un titulo y un enlace'); </script>";
        }
        
        $this->Close();

    }

    public function DeleteLink($id_link)
    {
        $this->Open();
        $query = "DELETE FROM my_links WHERE id_link = '" . $id_link . "'";
        mysqli_query($this->my_connection, $query);
        echo "<script> alert('Enlace eliminado'); </script>";
    }
}

// $test = new ConnectionDB();
// $test->Open();
// $test->Close();

?>