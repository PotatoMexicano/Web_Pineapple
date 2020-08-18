<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    private $vehicle;
    private $details;

    public function __construct(Vehicle $vehicle)
    {
        $vehicle = new Vehicle;
        $this->vehicle = $vehicle;
        $type = ['suv','van','sedan','pickup-truck','jeep','hatch','sport','crossover','cupê'];
        $color = ['gray','white','black','red','blue','brown','green','others'];
        $doors = ['2','3','4'];
        $this->details = [$type,$color,$doors];

    }

    public function index(Vehicle $vehicle)
    {
        if(\Auth::user()->level != 5){
            $this->vehicle = \DB::table('vehicles')->where('id_user',\Auth::user()->id);
        }else{
            $this->vehicle = \DB::table('vehicles');
        }
        $vehicles = $this->vehicle->paginate(15);
        $level_user = \Auth::user()->level;
        $pretty = "/json";
        return view('painel.vehicles.index', compact('vehicles','level_user','pretty'));
    }

    public function create()
    {
        $details = $this->details;
        $vehicle = $this->vehicle;
        return view('painel.vehicles.creater', compact('details'));
    }

    public function store(Request $request)
    {

        $data = $request->except('_token');
        $data['id_user'] = \Auth::user()->id;

        $validate = validator($request->all(), $this->vehicle->rules);

        if($validate->fails())
            return redirect()->route('vehicles.create')->withErrors($validate)->withInput();
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $name = str_replace(' ', '-',$request->brand).'-'.$request->license;
                $extension = $request->image->extension();
                $nameFile = "{$name}.{$extension}";
                $data['image'] = $nameFile;
                echo "ok";
            }
            $this->vehicle->attributes = $data;
            //$insert = $this->vehicle->insert([$data]);
            $insert = $this->vehicle->save();
            \Log::debug($this->vehicle);
            if($insert){
                if($request->hasFile('image')){
                    $upload = $request->image->storeAs('/vehicles',$nameFile);
            }else{
               return redirect()->back()->with(['error' => 'Falha upload']);
            }
            return redirect()->route('vehicles.index');
       } else {
            return redirect()->route('vehicles.index');
        }

    }

    public function show($id)
    {
        $vehicle = $this->vehicle->find($id);
        $user = User::find($vehicle->id_user);
        return view('painel.vehicles.viewer', compact('vehicle','user'));
    }

    //Para fins da API
    public function APIshow($license,$method)
    {
        if(Auth::check()){
            //Check login is valid
            if(Auth::user()->level != 5){
                dd("403 forbidden");
                //drop user if not admin
            }
        $id_user = \Auth::user()->id;
        //get user ID
        $user = User::find($id_user)->name;
        $vehicle = $this->vehicle->where('license','=',$license)->get();
        //search vehicle by license
        if(!$vehicle->isEmpty()){
            if($method == 'pretty'){
                dump('200 OK');
                dd($vehicle[0]->attributes);
            }
            elseif($method == 'json'){
                if($vehicle){
                    $vehicle = $vehicle[0];
		            $vehicle = $vehicle->toArray();
	        	    unset($vehicle['updated_at']);
		            unset($vehicle['created_at']);
		            header('Content-Type: application/json');
                    //echo json_encode($vehicle);
                    return \Response::json([
                        $vehicle,
                    ], 200);
                }else{
                    dump('400 Bad Request');
        		    echo 'not found vehicle with license '.$license;
                }
            }
            else{
                dump('400 Bad Request');
                dd('Method not found. Pretty or Text');
            }
        }
        else{
            dump('400 Bad Request');
            dd('not found vehicle with license '.$license);
        }
        }else{
            dd("401 Unauthorized");
        }
    }
    public function edit($id)
    {
        $vehicle = $this->vehicle->find($id);
        $colors = $this->details[1];
        $types = $this->details[0];
        $doors = $this->details[2];
        return view('painel.vehicles.manager', compact('vehicle','colors','types','doors'));
    }

    public function update(Request $request, $id)
    {
        $id_user = \Auth::user()->id;
        $data = $request->all();
        $vehicle = $this->vehicle->find($id);
        \Log::alert("Update: user: ".$id_user." vehicle: ".$vehicle->license);


        $data['image'] = $vehicle->image;
        $data['id_user'] = $id_user;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            if($vehicle->image){
                $name = pathinfo($vehicle->image)['filename'];
                $image = pathinfo($vehicle->image);
                if(file_exists(storage_path('app/public/vehicles'.$image['basename']))){
                    unlink(storage_path('app/public/vehicles/'.$image['basename']));
                }
            }else{
                $name = str_replace(' ', '-',$request->brand).'-'.$vehicle->license;
            }
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;
            $upload = $request->image->storeAs('/vehicles',$nameFile);
            if(!$upload)
                return redirect()->back()->with(['error' => 'Falha upload']);
            }
        $validate = validator($data, $this->vehicle->rules);
        if($validate->fails()){
            return redirect()->route('vehicles.edit', $id)->withErrors($validate)->withInput();
        }
        $update = $vehicle->update($data);
        if($update)
            return redirect()->route('vehicles.show', $id);
        else
            return redirect()->route('vehicles.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        if(Auth::check()){
        $vehicle = $this->vehicle->find($id);
        $delete = $vehicle->delete();
        if($delete){
            $name = pathinfo($vehicle->image)['filename'];
            $image = pathinfo($vehicle->image);
            if($name){
                if(file_exists(storage_path('app/public/vehicles/'.$image['basename']))){
                    unlink(storage_path('app/public/vehicles/'.$image['basename']));
                }
            }
            return redirect()->route('vehicles.index');
        }
        else{
          return redirect()->route('vehicles.index', $id)->with(['errors' => 'Fail']);
        }
    }

    }
}
