<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Http\Requests\BikeFormRequest;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private static function getData(){
        return [
            // ['id'=>1, 'name' => "S-Works Venge Di2-Sagan Collection", 'brand' =>'Specialized', 'price'=>'14,551,040원'],
            // ['id'=>2, 'name' => "S-Works Tarmac SL7", 'brand' =>'Specialized', 'price'=>'18,738,901원'],
            // ['id'=>3, 'name' => "Pinarello Dogma F12 Disk", 'brand' =>'Pinarello', 'price'=>'17,035,364원'],
            // ['id'=>4, 'name' => "BMC Teammachine SLR 01 Disc", 'brand' =>'BMC', 'price'=>'20,584,399원'],
        ];
    }

    public function index()
    {
        //
        return view('bikes.index',[
            // 'bikes' => self::getData(),
            'bikes' => Bike::all(),
            'userInput' => '<script>alert("목록조회 성공")</script>'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BikeFormRequest $request)
    {
        $data = $request->validated();
        //
        $bike = new Bike();//Bike모델을 이용해서, db연결하고 그 결과를 객체로 저장
        
        //$bike->name = strip_tags($request -> input('bike-name'));
        $bike->name = $data['bike-name'];
        $bike->brand = $data['bike-brand'];
        $bike->price = $data['bike-price'];

        $bike->save();
        return redirect()->route('bikes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bike $bike)
    {
        //
        // $bikes = self::getData();
        // $index = array_search($bike, array_column($bikes,'id'));

        return view('bikes.show',[
            // 'bike'=> Bike::findOrFail($bike)
            //  Bike $bike  == 'bike'=> Bike::findOrFail($bike)

            'bike'=> $bike
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bike $bike)
    {
        //
        return view('bikes.edit',[
            'bike'=> $bike
        ]);        
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    public function update(BikeFormRequest $request, Bike $bike)
    {
 
        $data = $request->validated();     

        $bike->name = $data['bike-name'];
        $bike->brand = $data['bike-brand'];
        $bike->price = $data['bike-price'];

        $bike->save();
        return redirect()->route('bikes.show', $bike->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
