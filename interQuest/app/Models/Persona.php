<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Persona
 * @package App\Models
 * @version May 8, 2018, 2:36 pm MDT
 *
 * @property \App\Models\Action action
 * @property \App\Models\Territory territory
 * @property \App\Models\Park park
 * @property \App\Models\Race race
 * @property \App\Models\User user
 * @property \App\Models\Vocation vocation
 * @property \Illuminate\Database\Eloquent\Collection ActionPersona
 * @property \Illuminate\Database\Eloquent\Collection buildingsTerritories
 * @property \Illuminate\Database\Eloquent\Collection Comment
 * @property \Illuminate\Database\Eloquent\Collection EquipmentPersona
 * @property \Illuminate\Database\Eloquent\Collection personasTitles
 * @property integer orkID
 * @property integer user_id
 * @property string name
 * @property string long_name
 * @property string image
 * @property integer vocation_id
 * @property integer race_id
 * @property string background_public
 * @property string background_private
 * @property integer park_id
 * @property integer territory_id
 * @property integer gold
 * @property integer iron
 * @property integer timber
 * @property integer stone
 * @property integer grain
 * @property integer action_id
 * @property boolean is_knight
 * @property boolean is_rebel
 * @property boolean is_monarch
 * @property integer fiefs_assigned
 * @property date shattered
 * @property date deceased
 */
class Persona extends Model
{
    use SoftDeletes;

    public $table = 'personas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'orkID',
        'user_id',
        'name',
        'long_name',
        'image',
        'vocation_id',
        'race_id',
        'background_public',
        'background_private',
        'park_id',
        'territory_id',
        'gold',
        'iron',
        'timber',
        'stone',
        'grain',
        'action_id',
        'is_knight',
        'is_rebel',
        'is_monarch',
        'fiefs_assigned',
        'shattered',
        'deceased'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'orkID' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'long_name' => 'string',
        'image' => 'string',
        'vocation_id' => 'integer',
        'race_id' => 'integer',
        'background_public' => 'string',
        'background_private' => 'string',
        'park_id' => 'integer',
        'territory_id' => 'integer',
        'gold' => 'integer',
        'iron' => 'integer',
        'timber' => 'integer',
        'stone' => 'integer',
        'grain' => 'integer',
        'action_id' => 'integer',
        'is_knight' => 'boolean',
        'is_rebel' => 'boolean',
        'is_monarch' => 'boolean',
        'fiefs_assigned' => 'integer',
        'shattered' => 'date',
        'deceased' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
	 * Accessors & Mutators
	 */
	public function getShatteredAttribute($value)
	{
		
		$response = null;
		if($value){
			if(strtotime($value) < strtotime('-6 days')){
				$this->shattered = null;
				$this->save();
				return $response;
			}else{
				return date("F jS, o", strtotime($value));
			}
		}
	}
	public function getImageAttribute($value)
	{
		if($value){
			if(strpos($value, 'http') !== null){
				return $value;
			}else{
				return '/storage/personae/' . $value;
			}
		}else{
			return '/img/profile.png';
		}
	}
	
	public function getFiefsAvailableAttribute()
	{
		
		//setup
		$count = 0;
		
		//noble titles
		if($this->titles->count() > 0){
			foreach($this->titles as $title){
				if($title->is_landed){
					$count = $count + $title->fiefs_maximum;
				}
			}
		}
		
		//knighthood
		if($this->is_knight){
			$count++;
		}
		
		//dump it
		return $count;
	}
	
	public function getFiefsCountAttribute(){
		
		//setup
		$total = 0;
		
		//iterate fiefdoms
		foreach($this->fiefdoms as $fiefdom){
			$total = $total + $fiefdom->fiefs->count();
		}
		
		//dump it
		return $total;
	}
	
	public function getGoldAttribute($value){
		
		//get/dump holdings
		return $this->holdingResources('gold', $value);
	}
	
	public function getIronAttribute($value){
		
		//get/dump holdings
		return $this->holdingResources('iron', $value);
	}
	
	public function getStoneAttribute($value){
		
		//get/dump holdings
		return $this->holdingResources('stone', $value);
	}
	
	public function getTimberAttribute($value){
		
		//get/dump holdings
		return $this->holdingResources('timber', $value);
	}
	
	public function getGrainAttribute($value){
		
		//get/dump holdings
		return $this->holdingResources('grain', $value);
	}
	
	public function holdingResources($resource, $value){

		//setup
		$total = $value;
		$locations = [];
		$persona = [
			'total'		=> $total, //amount there
			'vaulted'	=> 0		//valuted?  Not personally (yet)
		];

		//iterate holdings?
		if($this->fiefdoms->count() > 0){
			foreach($this->fiefdoms as $fiefdom){
				foreach($fiefdom->fiefs as $fief){
						
					//vault
					$vaulted = 0;
					if($fief->territory->buildings){
						foreach($fief->territory->buildings as $building){
							if($building->building->name == 'Vault'){
								$vaulted = 1;
								break;
							}
						}
					}
					
					//add it
					if($fief->territory->$resource > 0){
						$total = $total + $fief->territory->$resource;
						$locations[$fief->territory->id] = (object) [
							'total'		=> $fief->territory->$resource,
							'vaulted'	=> $vaulted,
							'name'		=> $fief->territory->name
						];
					}
				}
			}
		}
		
		//stewards get access to whatever funds are in their purview.
		//Note that nobles don't lose access to anything stored in this territory.
		if($this->fiefsStewarding->count() > 0){
			foreach($this->fiefsStewarding as $fief){
					
				//vault
				$vaulted = 0;
				if($fief->territory->buildings){
					foreach($fief->territory->buildings as $building){
						if($building->building->name == 'Vault'){
							$vaulted = 1;
							break;
						}
					}
				}
		
				if($fief->territory->$resource > 0){
					$total = $total + $fief->territory->$resource;
					$locations[$fief->territory->id] = (object) [
						'total'		=> $fief->territory->$resource,
						'vaulted'	=> $vaulted,
						'name'		=> $fief->territory->name
					];
				}
			}
		}
		
		//build response
		$response = [
			'total'		=> $total,
			'persona'	=> (object) $persona,
			'locations'	=> (object) $locations
		];
		
		//dump it
		return (object) $response;
	}

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function action()
    {
        return $this->belongsTo(\App\Models\Action::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
	public function home()
    {
        return $this->belongsTo(\App\Models\Territory::class, 'territory_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function park()
    {
        return $this->belongsTo(\App\Models\Park::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function race()
    {
        return $this->belongsTo(\App\Models\Race::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function vocation()
    {
        return $this->belongsTo(\App\Models\Vocation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function actions()
    {
        return $this->hasMany(\App\Models\ActionPersona::class)->orderBy('created_at', 'DESC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
	public function equipment()
    {
		return $this->hasMany(\App\Models\EquipmentPersona::class);
    }

    /**
	 * @return \Illuminate\Database\Eloquent\Relations\morphMany
	 **/
	public function fiefdoms()
	{
		return $this->morphMany('\App\Models\Fiefdom', 'ruler');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\morphMany
	 **/
	public function fiefsStewarding()
	{
		return $this->morphMany('\App\Models\Fief', 'steward');
	}

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function titles()
    {
        return $this->belongsToMany(\App\Models\Title::class, 'personas_titles');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 **/
	public function territories()
	{
		return $this->hasMany(\App\Models\Territory::class);
}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\morphMany
	 **/
	public function comments()
	{
		return $this->morphMany('\App\Models\Comment', 'commented');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\morphMany
	 **/
	public function revisions()
	{
		return $this->morphMany('\App\Models\Revision', 'changed');
	}
}
