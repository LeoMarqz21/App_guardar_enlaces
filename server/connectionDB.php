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
    private $my_name = "";
    private $my_password = "";
    private $my_user_id = "";

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
        if($this->my_name != '' && $this->my_password != ''){
            $query = "SELECT user_id FROM users WHERE user_name='" .$this->my_name . "' AND user_password='" . MD5($this->my_password) . "'";
            $result = mysqli_query($this->my_connection, $query);
            if(mysqli_num_rows($result) == 1){
                while($data = mysqli_fetch_array($result)){
                    $this->my_user_id = $data['id_user'];
                    return true;
                }
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function Register($full_name, $user_name, $user_password)
    {
        if($full_name != '' && $user_name != '' && $user_password != ''){

            $query1 = "SELECT * FROM users WHERE user_name='" . $user_name . "'";
            $check = mysqli_query($this->my_connection, $query1);
            if(mysqli_num_rows($check) == 1){
                return false;
            }else{
                $query2 = "INSERT INTO users (name, user_name, password) VALUES ('" . $full_name . "','" . $user_name . "','" . MD5($user_password) . "')";
                mysqli_query($this->my_connection, $query2);
                return true;
            }

        }else{
            return false;
        }
    }

    //https://qastack.mx/superuser/1146472/how-to-open-a-page-in-incognito-mode-from-html 
    //mode private

    //methods to add and remove links
    public function AddLink($title, $link)
    {
        # code...
    }

    public function DeleteLink($id_link)
    {
        # code...
    }
}

// $test = new ConnectionDB();
// $test->Open();
// $test->Close();

?>