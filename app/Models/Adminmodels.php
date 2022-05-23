<?php 
namespace App\Models;
use CodeIgniter\Model;

class Adminmodels extends Model
{
    public function insertData($data)
    {
       $builder = $this->db->table('authen');
       if($builder->insert($data))
       {
           return true;
       }
       return false;
    }

    public function google_user_exist($uid)
    {
       $builder = $this->db->table('social_login');
       $builder->where('oauth_id',$uid);
       if($builder->countAllResults() ==1)
       {
           return true;
       }
       else
       {
           return false;
       }
    }
    public function updateGoogleUser($data,$id)
    {
        $builder = $this->db->table('social_login');
        $builder->where('oauth_id',$id);
        $builder->update($data);
        if($this->db->affectedRows() ==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function createUser($data)
    {
        $builder = $this->db->table('social_login');
        $builder->insert($data);
        if($this->db->affectedRows() ==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}