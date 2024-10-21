<?php
<<<<<<< HEAD
=======
// app/Models/Community.php
>>>>>>> 8b3de3b7daf35623eeedd959dfe5676281983156

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

<<<<<<< HEAD
    // Combinez les champs des deux branches dans $fillable
=======
>>>>>>> 8b3de3b7daf35623eeedd959dfe5676281983156
    protected $fillable = ['name', 'description', 'image_url'];

    // Gardez la relation memberships() de la branche master
    public function memberships()
    {
        return $this->hasMany(Membership::class, 'communityId');
    }

<<<<<<< HEAD
    // Gardez aussi la relation tasks() de la branche khouloud
    public function tasks()
    {
        return $this->hasMany(Task::class);
=======
    public function tasksc()
    {
        return $this->hasMany(TaskC::class);
>>>>>>> 8b3de3b7daf35623eeedd959dfe5676281983156
    }
}
