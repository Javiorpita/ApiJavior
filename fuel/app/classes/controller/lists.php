<?php 
class Controller_Lists extends Controller_Rest
{


    public function post_createLists(){
        try {
           

            $input = $_POST;
            
            $list = new Model_Lists();
            $list->nameList = $input['nameList'];
            $list->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'Lista creada',
                'data' => ['listname' => $input['nameList']]
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
    public function get_lists()
    {

        $lists = Model_Lists::find('all');

        return $this->response(Arr::reindex($lists));

        

    }
}