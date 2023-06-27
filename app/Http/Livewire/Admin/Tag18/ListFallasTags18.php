<?php

namespace App\Http\Livewire\Admin\Tag18;

use App\Models\Centro;
use App\Models\Falla;
use App\Models\Planta;
use App\Models\Strabajo;
use App\Models\Tag18;
use App\Models\Trabajo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListFallasTags18 extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $state = [];
    public $centros=[];
    public $statefalla=[];
    public $statelistfalla=[];
    public $showAgregarTrabajoModal = false;
    public $foto_trabajo;
    public $statetrabajo =[];

    public $tag18;
    public $plantas;
    public $centro;
    public $tag;
    public $falla;
    public $trabajo_id_tag18s;
    public $tagnombre;
    public $descripcion;
    public $status;
    public $descripciontrabajo;
    public $consuleditFallaModal=false;
    public $id_tag18s;
    public $descripcionfalla;
    public $selectedStatusModal;
    public $foto_falla;


    public $selectedCentroListFallas = NULL;
    public $selectedPlantaListFallas = NULL;
    public $selectedStatusModalTrabajo = NULL;
    public $readyToLoad = false;


   /*  public function historialTag(Tag18 $tag18)
    {
        /* return view('livewire.admin.tag18.listfallas-tags18'); */


            /* dd($tag18); */
        /*  dd($tag18->id); */
        /* $this->showHistorialModal= true; */

        /* $this->tag18=$tag18;
        $this->statelistfalla =$tag18->toArray();
         dd($this->statelistfalla['id_cen']);

         $this->$selectedCentroListFallas = $this->statelistfalla['id_cen']; */

         /* return view('livewire.admin.tag18.list-fallas-tags18'); */

       /*   return redirect()->route('admin.tag18s.list-fallas'); */


      /*   $this->fallas = Falla:: where('id_tag18s', $tag18->id)
        ->get();
        */
        /* $selectedCentro= */

         /* return ($this->fallas); */

        /* return $fallas; */
        /* dd($BuscarF); */
        /* $tagNombre = $falla1->id_tag18s; */


        /*
        $this->selectedCentroFalla = $this->statefalla['id_cen'];
        $this->selectedPlantaFalla= $this->statefalla['id_planta'];

        $this->fallaplantas =Planta::all();*/



          /* return redirect()->route('admin.tag18s.list-tags');  */
        /* $this->selectedCentroFalla=='';
        $this->porAno==2024; */

        /* $this->selectedCentro ='LAZARO CARDENAS'; */
           /* return view('livewire.admin.tag18.list-tag18s'); */
          /* return view('livewire.admin.tag18.list-tags-fallas'); */



           /*  $this->dispatchBrowserEvent('show-formHistorial');*/
   /* } */
   public function editconsul(Falla $falla)
   {
       /* dd($falla); */
       $this->consuleditFallaModal = true;
       /*  dd('hola'); */
       $this->falla = $falla;
       $this->state = $falla->toArray();

        /* dd($this->state);  */

       $this->id_tag18s = $this->state['id_tag18s'];

       $this->descripcionfalla = $this->state['descripcion_falla'];
       $this->selectedStatusModal = $this->state['id_sfallas'];
       /* dd($this->id_tag18); */

       $tag18 = Tag18::find($this->id_tag18s);
       /*   return $tag18; */
       $tagNombre = $tag18->tag;
       $tagDescripcion = $tag18->descripcion;

       $this->tagnombre = $tagNombre;
       $this->descripcion = $tagDescripcion;
       /* $id_tag18s=$tag18->id; */

       $this->dispatchBrowserEvent('show-formfallaeditconsul');
   }

   public function updateFallaConsulta()
    {
        /* dd($this->state); */
        /* if($this->selectedStatusModal==""){
            $this->mensaje= 'Faltan parametros';
            /*  dd($this->mensaje); */
      /*   } */
        $validateDate = Validator::make(
            $this->state,
            [
                'descripcion_falla' => 'required',
                'id_sfallas' => 'required',
            ],
            [
                'descripcion_falla.required' => 'La descripcion de la falla es requerida.',
                'id_sfallas".required' => 'El Status es requerido.',

            ]
        )->validate();

        $validateDate['descripcion_falla'] = $this->descripcionfalla;
        $validateDate['id_sfallas'] = 3;
        /* dd($this->foto_falla); */
       /*   dd($this->selectedStatusModal); */

                /* COMPARAR SI ES NULLO */
        /* if (is_null($this->foto_falla)) {
            $this->mensaje= 'Faltan parametros';
            /* dd($this->mensaje);*/
     /*   } */

        if ($this->foto_falla) {
            $validateDate['foto_falla'] = $this->foto_falla->store('/', 'planta');
            /*   $validateDate['avatar'] = $this->photo->store('/', 'avatars'); */
        }

        $this->falla->update($validateDate);
        $this->dispatchBrowserEvent('hide-formfallaeditconsul', ['message' => 'Falla updated successfully!']);
    }

    public function agregartrabajo(Falla $falla)
   {
     /* dd($falla); */
    $this->showAgregarTrabajoModal=true;

    $this->falla=$falla;
        $this->statetrabajo=$falla->toArray();
      /*    dd($this->statetrabajo); */

        $this->trabajo_id_tag18s = $this->statetrabajo['id_tag18s'];

        $tag18 = Tag18::find($this->trabajo_id_tag18s);
        $this->tag18=$tag18;
      /*   dd($tag18); */
        /*   return $tag18; */
        $tagNombre = $tag18->tag;
        $tagDescripcion = $tag18->descripcion;

        $this->tagnombre = $tagNombre;
        $this->descripcion = $tagDescripcion;


    $this->dispatchBrowserEvent('show-formtrabajoAgregar');

   }

   public function addtrabajoitem()
   {
        /* dd($this->statetrabajo); */
        /* dd($this->selectedStatusModalTrabajo); */
         /* dd($this->descripciontrabajo); */
        /* dd($this->trabajo_id_tag18s);  */

        $tag18 = Tag18::find($this->trabajo_id_tag18s);
        $this->tag18=$tag18;

         $user_id=auth()->user()->id;
         $date = Carbon::now();
        /* $date = $date->format('Y-m-d'); */
        /* $date = $date->toTimeString(); */
         $date =$date->toDateTimeString();

        $validateDate= Validator::make(
           $this->statetrabajo,
           [
               'id'=>'required',
           ],
           [
               'id.required' =>' El Tag es requerido.',
           ]
            )->validate();

            $validateDate['id_falla']=$this->statetrabajo['id'];
            /* $validateDate['id_user'] = auth()->user()->id; */
            $validateDate['id_user'] = $this->statetrabajo['id_usuario'];
            /* $validateDate['id_strabajos']=$this->selectedStatusModalTrabajo; */
             $validateDate['id_strabajos'] = 5;
            $validateDate['des_trabajo'] =  strtoupper($this->descripciontrabajo);
            $validateDate['created_at']=$date;
            $validateDate['updated_at']=$date;
            $validateDate['id_tag18'] =$this->trabajo_id_tag18s;

           /* dd($this->validateDate); */

             if ($this->foto_trabajo) {
            $validateDate['foto_trabajo'] = $this->foto_trabajo->store('/', 'planta');
          /*   $validateDate['avatar'] = $this->photo->store('/', 'avatars'); */
            }

           Trabajo::create($validateDate);

           $validateFallas['id_sfallas'] = 4;
           $this->falla->update($validateFallas);

            $validateTag18['ttrabajo'] = 'TRUE';
            $this->tag18->update($validateTag18);

            $this->dispatchBrowserEvent('hide-formtrabajoAgregar',['message' => 'agregado trabajo satisfactorio!']);
   }


    public function mount(Tag18 $tag18)
    {
        /* se pasan los valores a los combos */

           $this->tag18 = $tag18;
           $this->statefalla=$tag18->toArray();
            /* dd($tag18); */

         $this->selectedCentroListFallas = $this->statefalla['id_cen'];
         $this->selectedPlantaListFallas = $this->statefalla['id_planta'];
         $this->tag = $this->statefalla['id'];

        /* $this->centros = Centro::all(); */
        $this->centros = Centro::orderBy('centro_id','DESC')->get();
        $this->plantas = Planta::orderby('nombre_planta','DESC')->get();

        $this->status = Strabajo::all();
        /* $fechaactual=now()->year;
        $this->porAno=$fechaactual; */


       /*  $fallas = Falla::with(['tagfallas', 'fllastatus'])
        ->where('id_tag18s','=', 1557); */

        /* $tagBusqueda= Tag18:: where('id','1557')->get(); */
             /* $fallas = Falla::where('id_tag18s','=',  $this->tag)->get(); */

          /* dd($fallas); */
         /* dd($tagBusqueda); */

    }

    public function render()
    {

        $fallas = Falla::where('id_tag18s','LIKE',$this->tag)->get();

        return view('livewire.admin.tag18.list-fallas-tags18')
         ->with('fallas', $fallas);
    }
}
