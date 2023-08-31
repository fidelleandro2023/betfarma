<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
   use HasFactory;

   protected $fillable = [
'name','description','short','parent_id','reference','user_id'
];
   public function parent_id()
   {      return category::get();
   }
   public function parent(): BelongsTo
   {
     return $this->belongsTo(self::class, 'parent_id');
   }

   public function parentRecursive(): BelongsTo
   {
     /***Ejemplo: Obtener todos los nodos del padre (Estructura arbol)**/     /*$user = category::find(8); **/
     /*$parent = category->parentRecursive;  4,2,1 */
     return $this->parent()->with('parentRecursive');
   }

   public function children(): HasMany
   {
     return $this->hasMany(self::class, 'parent_id');
   }
   public function childrenRecursive(): HasMany
   {
     return $this->children()->with('childrenRecursive');
   }
   public function user_id()
   {
      return User::get();
   }
}
