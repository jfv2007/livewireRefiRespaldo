<?php

namespace App\Http\Livewire\Admin\Falla;

use App\Models\Categoria;
use App\Models\Centro;
use App\Models\Falla;
use App\Models\Planta;
use App\Models\Seccion;
use App\Models\Stag;
use App\Models\Strabajo;
use App\Models\Tag18;
use App\Models\Trabajo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListFallas extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $centros = [];
    public $plantas = [];
    public $seccions=[];
    public $statetrabajo =[];
    public $fallastatus=[];

    public $categorias;
    public $status;
    public $foto_falla;
    public $foto_trabajo;
    public $editFallaModal = false;
    public $descripciontrabajo;
    public $falla;
    public $trabajo_id_tag18s;
    public $tagnombre;
    public $descripcion;
    public $planta;
    public $id_tag18s;
    public $descripcionfalla;
    public $selectedStatusModal;


    public $selectedCentro = NULL;
    public $selectedPlanta = NULL;
    public $selectedSeccion = NULL;
    public $selectedCategoria = NULL;
    public $selectedStatus = NULL;
    public $selectedStatusModalTrabajo = NULL;

    public $mensaje;
    public $error1 = false;

    public $fallaIdBeingRemoved = null;
    public $showAddTrabajoModal = false;


    public $byCenter = null;
    public $perPage = 5;
    public $sortBy = 'asc';
    public $search;
    public $porAno;



    public $readyToLoad = false;

    public function mount()
    {
        /* $this->centros = Centro::all(); */
        $this->centros = Centro::orderBy('centro_id', 'DESC')->get();
        $this->seccions = Seccion::all();
        $this->categorias = Categoria::all();
        $this->status = Strabajo::all();
        $this->fallastatus = Stag::all();
        $fechaactual=now()->year;
        $this->porAno=$fechaactual;

    }
    public function updatedselectedCentro($centro)
    {
        $this->readyToLoad = true;

        /* dd($centro);  */
        $this->plantas = Planta::where('id_centro', $centro)
            ->orderBy('nombre_planta', 'ASC')->get();
        /* $this->selectedPlanta = NULL; */
        $this->planta = $this->plantas->first()->id ?? null;
    }

    public function edit(Falla $falla)
    {
        /* dd($falla); */
        $this->editFallaModal = true;
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

        $this->dispatchBrowserEvent('show-formfallaedit');
    }

    public function updateFalla()
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
        $this->dispatchBrowserEvent('hide-formfallaedit', ['message' => 'Falla updated successfully!']);
    }
    public function confirmFallaRemoval($fallaId)
    {
        /* dd($tag18Id); */
        $this->fallaIdBeingRemoved = $fallaId;
        $this->dispatchBrowserEvent('show-delete-modal-falla');
    }
    public function deleteFalla()
    {
        $falla = Falla::findOrFail($this->fallaIdBeingRemoved);
        $falla->delete();
        $this->dispatchBrowserEvent('hide-delete-modal-falla', ['message' => 'La falla ha sido borrada exitosamente!']);
    }

    public function addtrabajo(Falla $falla)
    {   /* Muestra el modal con los datos */
        /*    dd($falla); */
           $this->showAddTrabajoModal= true;

         $this->falla=$falla;
        $this->statetrabajo=$falla->toArray();
      /*    dd($this->statetrabajo); */

        $this->trabajo_id_tag18s = $this->statetrabajo['id_tag18s'];

        $tag18 = Tag18::find($this->trabajo_id_tag18s);
        /*   return $tag18; */
        $tagNombre = $tag18->tag;
        $tagDescripcion = $tag18->descripcion;

        $this->tagnombre = $tagNombre;
        $this->descripcion = $tagDescripcion;



          $this->dispatchBrowserEvent('show-formtrabajoAdd');
    }

    public function additemtrabajo()
    {
           /* dd($this->statetrabajo); */
           /* dd($this->selectedStatusModalTrabajo); */
           /* dd($this->descripciontrabajo); */
          /*  dd($this->foto_trabajo); */

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
              $validateDate['id_strabajos']=$this->selectedStatusModalTrabajo;
            /*  $validateDate['id_strabajos'] = 4; */
             $validateDate['des_trabajo'] =  strtoupper($this->descripciontrabajo);
             $validateDate['created_at']=$date;
             $validateDate['updated_at']=$date;

            /* dd($this->validateDate); */

              if ($this->foto_trabajo) {
             $validateDate['foto_trabajo'] = $this->foto_trabajo->store('/', 'planta');
           /*   $validateDate['avatar'] = $this->photo->store('/', 'avatars'); */
             }

            Trabajo::create($validateDate);

            $validateFallas['id_sfallas'] = 4;
            $this->falla->update($validateFallas);

             $this->dispatchBrowserEvent('hide-formtrabajoAdd',['message' => 'agregado trabajo satisfactorio!']);

    }

    public function render()
    {
        /* dd($fallas);
         dd($this->porAno); */
        /* aqui muestra todas las fallas*/


            if ($this->readyToLoad  ) {
                /* $tag18s = Tag18::with(['tag18Centro', 'tag18Plantas'])
                ->when($this->selectedCentro, function ($query) {
                    $query->where('id_cen', $this->selectedCentro);
                })
                ->when($this->selectedPlanta, function ($query) {
                    $query->where('id_planta', $this->selectedPlanta);
                }) */

                  $fallas = Falla::with(['tagfallas', 'fllastatus'])
                       ->when($this->selectedCentro, function ($query){
                       $query->whereRelation('tagfallas', 'id_cen', $this->selectedCentro)
                       ->whereYear('created_at',now()->year($this->porAno));

                     /* $query->WhereHas('tagfallas', function ($query){
                        $query->where('id_cen', $this->selectedCentro);
                    });*/
                    })

                     ->when($this->selectedPlanta, function ($query) {
                        $query->WhereHas('tagfallas' , function ($query){
                            $query->where('id_planta', $this->selectedPlanta);
                    });
                    })

                    ->when($this->selectedCategoria, function ($query) {
                        $query->WhereHas('tagfallas' , function ($query){
                            $query->where('id_categoria',  $this->selectedCategoria);
                    });
                   })

                   ->when($this->selectedStatus, function ($query) {
                    $query->where('id_sfallas', $this->selectedStatus);
                    })

                    ->when($this->search, function($query){
                        $query->whereRelation('tagfallas', 'tag','like','%' .$this->search. '%');

                    })

                    ->paginate($this->perPage);

                   /*  ->toSql(); */


                    /* ->paginate(); */

                     /* dd($fallas); */
                 } else {
                    $fallas = [];
                }


        /*  dd($fallas); */
        return view('livewire.admin.falla.list-fallas')
            ->with('fallas', $fallas);
    }
}
