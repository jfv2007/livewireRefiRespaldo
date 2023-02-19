<?php

namespace App\Http\Livewire\Admin\Tag18;

use App\Models\Centro;
use App\Models\Falla;
use App\Models\Planta;
use App\Models\Tag18;
use Livewire\Component;



class ListFallasTags18 extends Component
{
    public $centros=[];
    public $statefalla=[];
    public $statelistfalla=[];

    public $tag18;
    public $plantas;
    public $centro;
    public $tag;

    public $selectedCentroListFallas = NULL;
    public $selectedPlantaListFallas = NULL;

    public $readyToLoad = false;


    public function historialTag(Tag18 $tag18)
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


       /*  $fallas = Falla::with(['tagfallas', 'fllastatus'])
        ->where('id_tag18s','=', 1557); */

        /* $tagBusqueda= Tag18:: where('id','1557')->get(); */
             $fallas = Falla::where('id_tag18s','=',  $this->tag)->get();

          /* dd($fallas); */
         /* dd($tagBusqueda); */

    }

    public function render()
    {
        $fallas = Falla::where('id_tag18s','=',  $this->tag)->get();


        return view('livewire.admin.tag18.list-fallas-tags18')
         ->with('fallas', $fallas);
    }
}
