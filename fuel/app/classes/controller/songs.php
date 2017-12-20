<?php 
class Controller_Songs extends Controller_Rest
{


    public function post_createSongs()
    {
        try {
           

            $input = $_POST;
            
            $song = new Model_Songs();
            $song->nameSongs = $input['nameSongs'];
            $song->id_list = $input['id_list'];
            $song->save();

            $json = $this->response(array(
                'code' => 200,
                'message' => 'Lista creada',
                'data' => ['songname' => $input['nameSongs']]
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

    public function get_songs()
    {

        $songs = Model_Users::find('all');

        return $this->response(Arr::reindex($songs));

        

    }
}