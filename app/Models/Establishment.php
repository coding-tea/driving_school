<?php

namespace App\Models;

use App\DTO\EtablissementDto;
use App\Models\UserManagement\Collaborator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Establishment extends Model
{
    use HasFactory;

    const PK = 'id';
    public $table = "establishments";
    protected $guarded = [];

    //    use HasImage;
    public function image()
    {
        return  $this->HasOne(Image::class, 'id', "logo");
    }

    public function dto(): EtablissementDto
    {
        return EtablissementDto::fromModel($this);
    }

    // public  function collaborators()
    // {
    //     return $this->belongsToMany(Collaborator::class, 'collaborator_establishments', "establishment_id", 'collaborator_id');
    // }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function centreformations()
    {
        return $this->hasMany(CentreFormation::class, 'etablissemment', 'id');
    }

    public static function filterByC($option = "", $secteur = "", $groupAnne = "")
    {
        $etabs = DB::table('establishments')->join('centres_formations', 'centres_formations.etablissemment', '=', 'establishments.id')
        ->join('centre_formation_option', 'centres_formations.idCF', '=', 'centre_formation_option.centreFormation');

        if (!empty($secteur)) {

            $etabs->join('options', 'centre_formation_option.option', '=', 'options.id')
                  ->join('secteurs', 'options.secteur', '=', 'secteurs.id')
                  ->where('options.id', $secteur);
        }

        if (!empty($option)) {
            $etabs->join('options', 'centre_formation_option.option', '=', 'options.id')
                  ->where('options.id', $option);
        }

        if (!empty($groupAnne)) {
            $etabs->join('options', 'centre_formation_option.option', '=', 'options.id')
                  ->join('filliere_niveau', 'options.id', '=', 'filliere_niveau.option');
        }

        return $etabs->get();
    }
    
    public function Options(){
        return $this->hasMany(Option::class, "establishment_id");
    }

    public function collaborators()
    {
        return $this->belongsTo(Collaborator::class, 'etablissement', 'id');
    }

}
