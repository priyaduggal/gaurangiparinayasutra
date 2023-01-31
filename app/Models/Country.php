<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    
    public function states()
    {
        return $this->hasmany(State::class)->withTrashed();
    }

    public function addresses()
    {
        return $this->hasmany(Address::class)->withTrashed();
    }
    
     public function castes(){
          return $users = DB::table('castes')->where('religion_id','9')->get();
     }
     public function educations()
    {
        
        return $users = DB::table('edu_cat_subcat')->orderby('cat_id','asc')->get();
        //return $this->hasmany(Address::class)->withTrashed();
    }
    
      public function occupation()
    {
        
        return $users = DB::table('occupations')->orderby('id','asc')->get();
        //return $this->hasmany(Address::class)->withTrashed();
    }
}
