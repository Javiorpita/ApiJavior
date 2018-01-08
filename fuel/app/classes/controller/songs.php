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

        $songs = Model_Songs::find('all');

        return $this->response(Arr::reindex($songs));

        

    }
    public function post_changeSong()
    {
        $input = $_POST;
        $song = new Model_Songs();
        $song = Model_Songs::find($_POST['id']);
        
        

        $song->nameSongs = $input['nameSongs'];

        $song->save();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'Canción modificada',
            'data' => ['nameSongs' => $input['nameSongs']]
        ));

        return $json;
    }
     public function post_delete()
    {
        $list = Model_Songs::find($_POST['id']);
        $songname = $list->nameSongs;
        $list->delete();

        $json = $this->response(array(
            'code' => 200,
            'message' => 'Canción borrada',
            'name' => $songname
        ));

        return $json;
    }
}