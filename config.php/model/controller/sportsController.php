<?php
// insert record
public function insertRecord($obj)
{
    try
    {
        $this->open_db();
        $query=$this->condb->prepare("INSERT INTO sports (category,name) VALUES (?, ?)");
        $query->bind_param("ss",$obj->category,$obj->name);
        $query->execute();
        $res= $query->get_result();
        $last_id=$this->condb->insert_id;
        $query->close();
        $this->close_db();
        return $last_id;
    }
    catch (Exception $e)
    {
        $this->close_db();
        throw $e;
    }
}
//update record
public function updateRecord($obj)
{
    try
    {
        $this->open_db();
        $query=$this->condb->prepare("UPDATE sports SET category=?,name=? WHERE id=?");
        $query->bind_param("ssi", $obj->category,$obj->name,$obj->id);
        $query->execute();
        $res=$query->get_result();
        $query->close();
        $this->close_db();
        return true;
    }
    catch (Exception $e)
    {
        $this->close_db();
        throw $e;
    }
}
 // delete record
public function deleteRecord($id)
{
    try{
        $this->open_db();
        $query=$this->condb->prepare("DELETE FROM sports WHERE id=?");
        $query->bind_param("i",$id);
        $query->execute();
        $res=$query->get_result();
        $query->close();
        $this->close_db();
        return true;
    }
    catch (Exception $e)
    {
        $this->closeDb();
        throw $e;
    }
}
// select record
public function selectRecord($id)
{
    try
    {
        $this->open_db();
        if($id>0)
        {
            $query=$this->condb->prepare("SELECT * FROM sports WHERE id=?");
            $query->bind_param("i",$id);
        }
        else
        {$query=$this->condb->prepare("SELECT * FROM sports");    }

        $query->execute();
        $res=$query->get_result();
        $query->close();
        $this->close_db();
        return $res;
    }
    catch(Exception $e)
    {
        $this->close_db();
        throw $e;
    }

}