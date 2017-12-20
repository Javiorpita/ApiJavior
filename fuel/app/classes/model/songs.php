<?php 

class Model_Songs extends Orm\Model
{
    protected static $_table_name = 'songs';
    

    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'nameSongs' => array(
            'data_type' => 'varchar'   
        ),
        'id_list' => array(
            'data_type' => 'int'   
        )
    );
}