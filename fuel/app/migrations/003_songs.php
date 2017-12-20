<?php
namespace Fuel\Migrations;


class songs
{

    function up()
    {
        \DBUtil::create_table('songs', array(
            'id' => array('type' => 'int', 'constraint' => 5,'auto_increment' => true),
            'nameSongs' => array('type' => 'varchar', 'constraint' => 100),
            'id_list' => array('type' => 'int', 'constraint' => 5),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'claveAjenaCancionesAListas',
            'key' => 'id_list',
            'reference' => array(
                'table' => 'lists',
                'column' => 'id',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
        
       
        )
    )
    
  );      
        
}

    function down()
    {
       \DBUtil::drop_table('songs');
    }
}