<?php 
class Controller_Users extends Controller_Rest
{
    private $key = "j9ijg90w34498u98jiufjvdi9vuu9jvr9idjr9jci";

    public function post_create()
    {
        try {
            if ( ! isset($_POST['name']) && ! isset($_POST['password'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'parametro incorrecto, se necesita que el parametro se llame name'
                ));

                return $json;
            }

            $input = $_POST;
            $user = new Model_Users();
            $user->name = $input['name'];
            $user->password = $input['password'];
            $user->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
                'data' => ['username' => $input['name']]
            ));

            return $json;

        } 
        catch (Exception $e) 
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage(),
            ));

            return $json;
        }
        

        
    }

    public function get_users()
    {

    	$users = Model_Users::find('all');

    	return $this->response(Arr::reindex($users));

        

    }

    public function post_delete()
    {
        $user = Model_Users::find($_POST['id']);
        $userName = $user->name;
        $user->delete();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'usuario borrado',
            'name' => $userName
        ));

        return $json;
    }
    public function post_changePassword()
    {
        $input = $_POST;
        $user = new Model_Users();
        $user = Model_Users::find($_POST['id']);
        
        

        $user->password = $input['password'];

        $user->save();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'contraseña modificada',
            'data' => ['password' => $input['password']]
        ));

        return $json;
    }
    public function get_login()
    {
        try{
            $input = $_GET;
        
            $users = Model_Users::find('all', array('where' => array(array('name',$input['name']),array('password',$input['password']) )));
         
            if (! empty ($user))
            {   

                foreach ($user as $key => $value)
                {
                    $id = $user[$key]->id;
                    $name = $user[$key]->name;
                    $password = $user[$key]->password;

                }
            }
                else
                {
                    return $this->response(array('401','Error de autentificacion'));
                }

                if ($name == $input['name'] && $password == $input['password'])
                {
                    $dataToken = array(
                        "id" => $id,
                        "name" => $name,
                        "password" => $password
                    );
                $token = JWT::encode($dataToken, $this->key);

                return $this->response(array('220','login correcto',['token' => $token, 'username' => $name]));

                }
                else
                {
                return $this->response(array('401','Error de autentificación'));
                }

        }

        catch (Exception $e)
        {
        return $this->response(array('500',$e->getMessage()));
        }


    }

    

    
}