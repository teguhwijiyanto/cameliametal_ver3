<?php

namespace App\Http\Controllers\operator;

use App\Models\Oee;
use App\Models\User;
use App\Models\Downtime;
use App\Models\Smelting;
use App\Models\Workorder;
use App\Models\Production;
use App\Models\Realtime;
use Illuminate\Http\Request;
use App\Http\Requests\OeeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductionRequest;
use App\Http\Resources\Downtime\DowntimeCollection;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workorder = Workorder::where('status_wo','on process')->first();
        if(!$workorder)
        {
            return redirect(route('workorder.index'));
        }
        $productions = Production::where('workorder_id',$workorder->id)->get();
        $user       = User::where('id',$workorder->user_id)->first();
        $smeltings  = Smelting::where('workorder_id',$workorder->id)->orderBy('bundle_num','ASC')->get();
        $smeltingInputList = [];
        foreach ($smeltings as $smelting) 
        {
            $productionCheck = Production::where('workorder_id',$workorder->id)->where('bundle_num',$smelting->bundle_num)->first();
            if($productionCheck == null)
            {
                $smeltingInputList[] = $smelting->bundle_num;
            }
        }
        $oee        = Oee::where('workorder_id',$workorder->id)->first();
        $downtimes  = Downtime::where('is_remark_filled',false)
                                ->where('workorder_id',$workorder->id)
                                ->where('status','stop')
                                ->orWhere('is_downtime_stopped',false)
                                ->orderby('id','desc')
                                ->get();
        $productionCount = 0;
        foreach($productions as $prod)
        {
            $productionCount += $prod->pcs_per_bundle;
        }
        $totalDowntime = 0;

        $downtimeSummary = Downtime::where('status','run')
                                ->orWhere('is_downtime_stopped',true)
                                ->where('workorder_id',$workorder->id)
                                ->get();
        foreach($downtimeSummary as $dt)
        {
            $totalDowntime += $dt->downtime;
        }


        $actual_qty_production = Realtime::select('counter')->where('workorder_id',$workorder->id)
                                 ->orderBy('created_at', 'desc')->first();

        $jml_smelting = Smelting::select('id')->where('workorder_id',$workorder->id)->count();

        $fg_qty_pcs  = Workorder::select('fg_qty_pcs')->where('id',$workorder->id)->get();

$total_good_product = 0;
$pcs_per_bundles = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
        foreach($pcs_per_bundles as $pcs_per_bund)
        {
            $total_good_product += $pcs_per_bund->pcs_per_bundle;
        }


		return view('operator.production.index',[
            'title'                 => 'Production Report',
            'workorder'             => $workorder,
            'createdBy'             => $user,
            'smeltings'             => $smeltings,
            'productions'           => $productions,
            'reports'               => [
                'production_count'  => $productionCount,
                'total_downtime'    => $totalDowntime,
            ],
            'smeltingInputList'     => $smeltingInputList,
            'oee'                   => $oee,
            'actual_qty_production' => $actual_qty_production,
            'jml_smelting'          => $jml_smelting,
			'fg_qty_pcs'            => $fg_qty_pcs,
			'total_good_product'    => $total_good_product,
            'downtimes'             => $downtimes
        ]);
		
    }



    public function spvindex()
    {
        //
        $workorder = Workorder::where('status_wo','on check')->first();
        if(!$workorder)
        {
            return redirect(route('workorder.index'));
        }
        $productions = Production::where('workorder_id',$workorder->id)->get();
        $user       = User::where('id',$workorder->user_id)->first();
        $smeltings  = Smelting::where('workorder_id',$workorder->id)->orderBy('bundle_num','ASC')->get();
        $smeltingInputList = [];
        foreach ($smeltings as $smelting) 
        {
            $productionCheck = Production::where('workorder_id',$workorder->id)->where('bundle_num',$smelting->bundle_num)->first();
            if($productionCheck == null)
            {
                $smeltingInputList[] = $smelting->bundle_num;
            }
        }
        $oee        = Oee::where('workorder_id',$workorder->id)->first();
        $downtimes  = Downtime::where('is_remark_filled',false)
                                ->where('workorder_id',$workorder->id)
                                ->where('status','stop')
                                ->orWhere('is_downtime_stopped',false)
                                ->orderby('id','desc')
                                ->get();
        $productionCount = 0;
        foreach($productions as $prod)
        {
            $productionCount += $prod->pcs_per_bundle;
        }
        $totalDowntime = 0;

        $downtimeSummary = Downtime::where('status','run')
                                ->orWhere('is_downtime_stopped',true)
                                ->where('workorder_id',$workorder->id)
                                ->get();
        foreach($downtimeSummary as $dt)
        {
            $totalDowntime += $dt->downtime;
        }


        $actual_qty_production = Realtime::select('counter')->where('workorder_id',$workorder->id)
                                 ->orderBy('created_at', 'desc')->first();

        $jml_smelting = Smelting::select('id')->where('workorder_id',$workorder->id)->count();

        $fg_qty_pcs  = Workorder::select('fg_qty_pcs')->where('id',$workorder->id)->get();

$total_good_product = 0;
$pcs_per_bundles = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
        foreach($pcs_per_bundles as $pcs_per_bund)
        {
            $total_good_product += $pcs_per_bund->pcs_per_bundle;
        }


		return view('supervisor.production.index',[
            'title'                 => 'Production Report',
            'workorder'             => $workorder,
            'createdBy'             => $user,
            'smeltings'             => $smeltings,
            'productions'           => $productions,
            'reports'               => [
                'production_count'  => $productionCount,
                'total_downtime'    => $totalDowntime,
            ],
            'smeltingInputList'     => $smeltingInputList,
            'oee'                   => $oee,
            'actual_qty_production' => $actual_qty_production->counter,
            'jml_smelting'          => $jml_smelting,
			'fg_qty_pcs'            => $fg_qty_pcs,
			'total_good_product'    => $total_good_product,
            'downtimes'             => $downtimes
        ]);
    }


    public function oprshow()
    {
        //
        $workorder = Workorder::where('status_wo','on process')->first();
        if(!$workorder)
        {
            return redirect(route('workorder.index'));
        }
        $productions = Production::where('workorder_id',$workorder->id)->get();
        $user       = User::where('id',$workorder->user_id)->first();
        $smeltings  = Smelting::where('workorder_id',$workorder->id)->orderBy('bundle_num','ASC')->get();
        $smeltingInputList = [];
        foreach ($smeltings as $smelting) 
        {
            $productionCheck = Production::where('workorder_id',$workorder->id)->where('bundle_num',$smelting->bundle_num)->first();
            if($productionCheck == null)
            {
                $smeltingInputList[] = $smelting->bundle_num;
            }
        }
        $oee        = Oee::where('workorder_id',$workorder->id)->first();
        $downtimes  = Downtime::where('is_remark_filled',false)
                                ->where('workorder_id',$workorder->id)
                                ->where('status','stop')
                                ->orWhere('is_downtime_stopped',false)
                                ->orderby('id','desc')
                                ->get();
        $productionCount = 0;
        foreach($productions as $prod)
        {
            $productionCount += $prod->pcs_per_bundle;
        }
        $totalDowntime = 0;

        $downtimeSummary = Downtime::where('status','run')
                                ->orWhere('is_downtime_stopped',true)
                                ->where('workorder_id',$workorder->id)
                                ->get();
        foreach($downtimeSummary as $dt)
        {
            $totalDowntime += $dt->downtime;
        }


        $actual_qty_production = Realtime::select('counter')->where('workorder_id',$workorder->id)
                                 ->orderBy('created_at', 'desc')->first();

        $jml_smelting = Smelting::select('id')->where('workorder_id',$workorder->id)->count();

        $fg_qty_pcs  = Workorder::select('fg_qty_pcs')->where('id',$workorder->id)->get();

$total_good_product = 0;
$pcs_per_bundles = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
        foreach($pcs_per_bundles as $pcs_per_bund)
        {
            $total_good_product += $pcs_per_bund->pcs_per_bundle;
        }
 

		return view('operator.production.show_detail',[
            'title'                 => 'Production Report',
            'workorder'             => $workorder,
            'createdBy'             => $user,
            'smeltings'             => $smeltings,
            'productions'           => $productions,
            'reports'               => [
                'production_count'  => $productionCount,
                'total_downtime'    => $totalDowntime,
            ],
            'smeltingInputList'     => $smeltingInputList,
            'oee'                   => $oee,
            'actual_qty_production' => $actual_qty_production->counter,
            'jml_smelting'          => $jml_smelting,
			'fg_qty_pcs'            => $fg_qty_pcs,
			'total_good_product'    => $total_good_product,
            'downtimes'             => $downtimes
        ]);
    } // public function oprshow()



    public function spvshow()
    {
        //
        $workorder = Workorder::where('status_wo','on check')->first();
        if(!$workorder)
        {
            return redirect(route('workorder.index'));
        }
        $productions = Production::where('workorder_id',$workorder->id)->get();
        $user       = User::where('id',$workorder->user_id)->first();
        $smeltings  = Smelting::where('workorder_id',$workorder->id)->orderBy('bundle_num','ASC')->get();
        $smeltingInputList = [];
        foreach ($smeltings as $smelting) 
        {
            $productionCheck = Production::where('workorder_id',$workorder->id)->where('bundle_num',$smelting->bundle_num)->first();
            if($productionCheck == null)
            {
                $smeltingInputList[] = $smelting->bundle_num;
            }
        }
        $oee        = Oee::where('workorder_id',$workorder->id)->first();
        $downtimes  = Downtime::where('is_remark_filled',false)
                                ->where('workorder_id',$workorder->id)
                                ->where('status','stop')
                                ->orWhere('is_downtime_stopped',false)
                                ->orderby('id','desc')
                                ->get();
        $productionCount = 0;
        foreach($productions as $prod)
        {
            $productionCount += $prod->pcs_per_bundle;
        }
        $totalDowntime = 0;

        $downtimeSummary = Downtime::where('status','run')
                                ->orWhere('is_downtime_stopped',true)
                                ->where('workorder_id',$workorder->id)
                                ->get();
        foreach($downtimeSummary as $dt)
        {
            $totalDowntime += $dt->downtime;
        }


        $actual_qty_production = Realtime::select('counter')->where('workorder_id',$workorder->id)
                                 ->orderBy('created_at', 'desc')->first();

        $jml_smelting = Smelting::select('id')->where('workorder_id',$workorder->id)->count();

        $fg_qty_pcs  = Workorder::select('fg_qty_pcs')->where('id',$workorder->id)->get();

$total_good_product = 0;
$pcs_per_bundles = Production::select('pcs_per_bundle')->where('workorder_id',$workorder->id)->where('bundle_judgement',1)->get();  
        foreach($pcs_per_bundles as $pcs_per_bund)
        {
            $total_good_product += $pcs_per_bund->pcs_per_bundle;
        }


		return view('supervisor.production.show_detail',[
            'title'                 => 'Production Report',
            'workorder'             => $workorder,
            'createdBy'             => $user,
            'smeltings'             => $smeltings,
            'productions'           => $productions,
            'reports'               => [
                'production_count'  => $productionCount,
                'total_downtime'    => $totalDowntime,
            ],
            'smeltingInputList'     => $smeltingInputList,
            'oee'                   => $oee,
            'actual_qty_production' => $actual_qty_production->counter,
            'jml_smelting'          => $jml_smelting,
			'fg_qty_pcs'            => $fg_qty_pcs,
			'total_good_product'    => $total_good_product,
            'downtimes'             => $downtimes
        ]);
    }


    public function getSmeltingNum(Request $request)
    {
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        $smelting   = Smelting::where('workorder_id',$workorder->id)->where('bundle_num',$request->bundle_num)->first();
        return response()->json([
            $smelting->smelting_num
        ]);
    }

    public function getProductionInfo(Request $request)
    {
        $production = Production::where('workorder_id',$request->workorder_id)
                        ->where('bundle_num',$request->smelting_number)->first();
        if (!$production) {
            return response()->json('Data not found',404);
        }
        return response()->json($production,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductionRequest $request)
    {
        //
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        if(!$workorder)
        {
            return response()->json([
                'message' => 'Workorder Not Found'
            ],400);
        }
        $production = Production::where('workorder_id',$request->workorder_id)->where('bundle_num',$request->bundle_num)->get();
        if(count($production) != 0)
        {
            return response()->json([
                'message' => 'Data Already Input'
            ],400);
        }
        $production = Production::create([
            'workorder_id'      => $request->workorder_id,
            'bundle_num'        => $request->bundle_num,
            'dies_num'          => $request->dies_num,
            'diameter_ujung'    => $request->diameter_ujung,
            'diameter_tengah'   => $request->diameter_tengah,
            'diameter_ekor'     => $request->diameter_ekor,
            'kelurusan_aktual'  => $request->kelurusan_aktual,
            'panjang_aktual'    => $request->panjang_aktual,
            'berat_fg'          => $request->berat_fg,
            'pcs_per_bundle'    => $request->pcs_per_bundle,
            'bundle_judgement'  => $request->bundle_judgement,
            'visual'            => $request->visual
        ]);

        $smeltingData = Smelting::select('id')->where('workorder_id',$workorder->id)->get();
        $smeltingNum = count($smeltingData);
        $productionData = Production::select('id')->where('workorder_id',$workorder->id)->get();
        $productionNum = count($productionData);
        $oeeData        = Oee::select('id')->where('workorder_id',$workorder->id)->first();
        if($smeltingNum == $productionNum && $oeeData != null){
            Workorder::where('id',$workorder->id)->update(['status_wo'=>'closed']);
        }

        return response()->json([
            'message' => 'Submitted Successfully'
        ],201);
    }

    public function storeOee(OeeRequest $request)
    {
        //
        $workorder = Workorder::where('id',$request->workorder_id)->first();
        if(!$workorder)
        {
            return response()->json([
                'message' => 'Workorder Not Found'
            ],400);
        }
        $oee = Oee::where('workorder_id',$request->workorder_id)->first();
        if($oee != null)
        {
            return response()->json([
                'message' => 'Data Already Input'
            ],400);
        }
        $oee = Oee::create([
            'workorder_id'              => $request->workorder_id,
            'dt_briefing'               => $request->dt_briefing,
            'dt_cek_shot_blast'         => $request->dt_cek_shot_blast,
            'dt_cek_mesin'              => $request->dt_cek_mesin,
            'dt_sambung_bahan'          => $request->dt_sambung_bahan,
            'dt_bongkar_pasang_dies'    => $request->dt_bongkar_pasang_dies,
            'dt_setting_awal'           => $request->dt_setting_awal,
            'dt_selesai_satu_bundle'    => $request->dt_selesai_satu_bundle,
            'dt_cleaning_area_mesin'    => $request->dt_cleaning_area_mesin,
            'dt_tunggu_bahan_baku'      => $request->dt_tunggu_bahan_baku,
            'dt_ganti_bahan_baku'       => $request->dt_ganti_bahan_baku,
            'dt_tunggu_dies'            => $request->dt_tunggu_dies,
            'dt_gosok_dies'             => $request->dt_gosok_dies,
            'dt_ganti_part_shot_blast'  => $request->dt_ganti_part_shot_blast,
            'dt_putus_dies'             => $request->dt_putus_dies,
            'dt_setting_ulang_kelurusan'    => $request->dt_setting_ulang_kelurusan,
            'dt_ganti_polishing_dies'   => $request->dt_ganti_polishing_dies,
            'dt_ganti_nozle_polishing_mesin'    => $request->dt_ganti_nozle_polishing_mesin,
            'dt_ganti_roller_straightener'  => $request->dt_ganti_roller_straightener,
            'dt_dies_rusak'             => $request->dt_dies_rusak,
            'dt_mesin_trouble_operator' => $request->dt_mesin_trouble_operator,
            'dt_validasi_qc'            => $request->dt_validasi_qc,
            'dt_mesin_trouble_maintenance'  => $request->dt_mesin_trouble_maintenance,
            'dt_istirahat'              => $request->dt_istirahat,
            'total_runtime'             => $request->total_runtime,
            'total_downtime'            => $request->total_downtime
        ]);

        $smeltingData = Smelting::select('id')->where('workorder_id',$workorder->id)->get();
        $smeltingNum = count($smeltingData);
        $productionData = Production::select('id')->where('workorder_id',$workorder->id)->get();
        $productionNum = count($productionData);
        $oeeData        = Oee::select('id')->where('workorder_id',$workorder->id)->first();
        if($smeltingNum == $productionNum && $oeeData != null){
            Workorder::where('id',$workorder->id)->update(['status_wo'=>'closed']);
        }

        return response()->json([
            'message' => 'Submitted Successfully'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
